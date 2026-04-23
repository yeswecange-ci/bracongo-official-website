<?php

namespace App\Support;

use Illuminate\Support\Collection;

/**
 * Normalisation des URLs YouTube pour iframe (partagé admin + front).
 */
final class YoutubeEmbed
{
    public static function normalizeUrl(string $url): ?string
    {
        $url = trim($url);
        if ($url === '') {
            return null;
        }

        if (preg_match('#^https?://(www\.)?youtube\.com/embed/([A-Za-z0-9_-]{6,})#', $url, $m)) {
            return 'https://www.youtube.com/embed/'.$m[2];
        }

        if (preg_match('#^https?://(www\.)?youtube\.com/watch\?v=([A-Za-z0-9_-]{6,})#', $url, $m)) {
            return 'https://www.youtube.com/embed/'.$m[2];
        }

        if (preg_match('#^https?://youtu\.be/([A-Za-z0-9_-]{6,})#', $url, $m)) {
            return 'https://www.youtube.com/embed/'.$m[1];
        }

        return null;
    }

    /**
     * Parse un texte libre (textarea admin) contenant une ou plusieurs entrées YouTube.
     * Accepte :
     *  - une URL par ligne (embed, watch?v=, youtu.be)
     *  - le code HTML <iframe ... src="..."> entier (multi-lignes ok)
     *
     * Retourne un tableau d'URLs embed canoniques, dédoublonnées.
     */
    public static function parseRaw(?string $raw): array
    {
        if (! filled($raw)) {
            return [];
        }

        $found = [];

        // Coller un bloc <iframe> (éventuellement sur plusieurs lignes) : extraire src="..."
        if (preg_match_all('/<iframe[\s\S]*?\bsrc=["\']([^"\']+)["\']/i', $raw, $m)) {
            foreach ($m[1] as $src) {
                $n = self::normalizeUrl(trim($src));
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
            $n = self::normalizeUrl($line);
            if ($n !== null) {
                $found[] = $n;
            }
        }

        return collect($found)->unique()->values()->all();
    }

    /**
     * @param  mixed  $raw  Attribut casté array, JSON string, ou null
     * @return Collection<int, string> URLs embed prêtes pour src d'iframe
     */
    public static function collectEmbedUrls(mixed $raw): Collection
    {
        if (is_string($raw)) {
            $decoded = json_decode($raw, true);
            $raw = is_array($decoded) ? $decoded : [];
        }
        if (! is_array($raw)) {
            $raw = [];
        }

        return collect($raw)
            ->map(function ($item) {
                if (! is_string($item)) {
                    return null;
                }

                return self::normalizeUrl($item);
            })
            ->filter()
            ->unique()
            ->values();
    }
}
