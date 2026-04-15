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
