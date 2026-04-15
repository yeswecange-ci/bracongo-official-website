<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Support\YoutubeEmbed;
use App\Traits\HandlesImageUpload;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    use HandlesImageUpload;
    public function index(Request $request)
    {
        $types = News::types();
        $type  = $request->query('type');
        if ($type && !array_key_exists($type, $types)) {
            $type = null;
        }

        $query = News::orderBy('date_publication', 'desc')->orderBy('ordre');
        if ($type) {
            $query->where('type', $type);
        }
        $news = $query->get();

        return view('admin.news.index', compact('news', 'types', 'type'));
    }

    public function create()
    {
        $types = News::types();
        return view('admin.news.create', compact('types'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre'            => 'required|string|max:255',
            'slug'             => 'required|string|max:255|unique:news',
            'type'             => 'required|in:actualites,evenements,activations,sponsoring,communiques,mediatheque',
            'extrait'          => 'nullable|string',
            'contenu'          => 'nullable|string',
            'image'            => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:10240',
            'gallery_images'   => 'nullable|array|max:30',
            'gallery_images.*' => 'image|mimes:jpeg,jpg,png,gif,webp|max:10240',
            'youtube_urls'     => 'nullable|string',
            'lien_externe'     => 'nullable|string|max:255',
            'whatsapp_url'     => 'nullable|string|max:500',
            'whatsapp_label'   => 'nullable|string|max:200',
            'date_evenement'   => 'nullable|date',
            'lieu'             => 'nullable|string|max:255',
            'ordre'            => 'nullable|integer|min:0',
            'is_active'        => 'nullable|boolean',
        ]);
        $data['whatsapp_url'] = filled(trim((string) ($data['whatsapp_url'] ?? ''))) ? trim($data['whatsapp_url']) : null;
        $data['whatsapp_label'] = filled(trim((string) ($data['whatsapp_label'] ?? ''))) ? trim($data['whatsapp_label']) : null;
        if ($data['whatsapp_url'] === null) {
            $data['whatsapp_label'] = null;
        }
        $data['is_active'] = $request->boolean('is_active');
        $data['date_publication'] = now()->toDateString();
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), 'uploads/news', 'news');
        } else {
            unset($data['image']);
        }
        $data['gallery_images'] = $this->uploadGalleryImages($request);
        $data['youtube_urls'] = $this->parseYoutubeUrls($request->input('youtube_urls'));

        News::create($data);

        return redirect()->route('admin.news.index')->with('success', 'News ajoutée.');
    }

    public function edit(News $news)
    {
        $types = News::types();
        return view('admin.news.edit', compact('news', 'types'));
    }

    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'titre'            => 'required|string|max:255',
            'slug'             => 'required|string|max:255|unique:news,slug,' . $news->id,
            'type'             => 'required|in:actualites,evenements,activations,sponsoring,communiques,mediatheque',
            'extrait'          => 'nullable|string',
            'contenu'          => 'nullable|string',
            'image'            => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:10240',
            'gallery_images'   => 'nullable|array|max:30',
            'gallery_images.*' => 'image|mimes:jpeg,jpg,png,gif,webp|max:10240',
            'remove_gallery_images'   => 'nullable|array',
            'remove_gallery_images.*' => 'string',
            'youtube_urls'     => 'nullable|string',
            'lien_externe'     => 'nullable|string|max:255',
            'whatsapp_url'     => 'nullable|string|max:500',
            'whatsapp_label'   => 'nullable|string|max:200',
            'date_evenement'   => 'nullable|date',
            'lieu'             => 'nullable|string|max:255',
            'ordre'            => 'nullable|integer|min:0',
            'is_active'        => 'nullable|boolean',
        ]);
        $data['whatsapp_url'] = filled(trim((string) ($data['whatsapp_url'] ?? ''))) ? trim($data['whatsapp_url']) : null;
        $data['whatsapp_label'] = filled(trim((string) ($data['whatsapp_label'] ?? ''))) ? trim($data['whatsapp_label']) : null;
        if ($data['whatsapp_url'] === null) {
            $data['whatsapp_label'] = null;
        }
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), 'uploads/news', 'news');
        } else {
            unset($data['image']);
        }
        $data['gallery_images'] = $this->syncGalleryImages($request, $news);
        $data['youtube_urls'] = $this->parseYoutubeUrls($request->input('youtube_urls'));

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'News mise à jour.');
    }

    public function destroy(News $news)
    {
        $this->deleteImageFile($news->image);
        foreach (($news->gallery_images ?? []) as $img) {
            $this->deleteImageFile($img);
        }
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'News supprimée.');
    }

    private function uploadGalleryImages(Request $request): array
    {
        $paths = [];
        foreach ($request->file('gallery_images', []) as $file) {
            $paths[] = $this->uploadImage($file, 'uploads/news/gallery', 'news-gallery');
        }

        return $paths;
    }

    private function syncGalleryImages(Request $request, News $news): array
    {
        $existing = collect($news->gallery_images ?? []);
        $toRemove = collect($request->input('remove_gallery_images', []));

        if ($toRemove->isNotEmpty()) {
            $existing = $existing->reject(function (string $img) use ($toRemove) {
                if ($toRemove->contains($img)) {
                    $this->deleteImageFile($img);
                    return true;
                }
                return false;
            })->values();
        }

        $newUploads = $this->uploadGalleryImages($request);

        return $existing->merge($newUploads)->take(30)->values()->all();
    }

    private function parseYoutubeUrls(?string $raw): array
    {
        if (! filled($raw)) {
            return [];
        }

        $found = [];

        // Coller un bloc <iframe> (éventuellement sur plusieurs lignes) : extraire src="..."
        if (preg_match_all('/<iframe[\s\S]*?\bsrc=["\']([^"\']+)["\']/i', $raw, $m)) {
            foreach ($m[1] as $src) {
                $n = YoutubeEmbed::normalizeUrl(trim($src));
                if ($n !== null) {
                    $found[] = $n;
                }
            }
        }

        // Une URL par ligne (sans ré-analyser les lignes qui sont déjà du HTML iframe)
        foreach (preg_split('/\r\n|\r|\n/', $raw) ?: [] as $line) {
            $line = trim($line);
            if ($line === '' || stripos($line, '<iframe') !== false) {
                continue;
            }
            $n = YoutubeEmbed::normalizeUrl($line);
            if ($n !== null) {
                $found[] = $n;
            }
        }

        return collect($found)->unique()->values()->all();
    }
}
