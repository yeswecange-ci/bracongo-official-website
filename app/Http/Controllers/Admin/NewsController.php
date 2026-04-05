<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
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
            'image'            => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'lien_externe'     => 'nullable|string|max:255',
            'date_publication' => 'nullable|date',
            'date_evenement'   => 'nullable|date',
            'lieu'             => 'nullable|string|max:255',
            'ordre'            => 'nullable|integer|min:0',
            'is_active'        => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), 'uploads/news', 'news');
        } else {
            unset($data['image']);
        }

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
            'image'            => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
            'lien_externe'     => 'nullable|string|max:255',
            'date_publication' => 'nullable|date',
            'date_evenement'   => 'nullable|date',
            'lieu'             => 'nullable|string|max:255',
            'ordre'            => 'nullable|integer|min:0',
            'is_active'        => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->file('image'), 'uploads/news', 'news');
        } else {
            unset($data['image']);
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('success', 'News mise à jour.');
    }

    public function destroy(News $news)
    {
        $this->deleteImageFile($news->image);
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'News supprimée.');
    }
}
