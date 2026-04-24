<?php

namespace App\Support;

final class CmsHtmlSanitizer
{
    /**
     * Balises HTML autorisées dans les champs CMS.
     * Syntaxe tableau (PHP 7.4+) pour éviter le bug de préfixe de strip_tags()
     * en syntaxe chaîne (ex : <u> élimine incorrectement <ul>).
     */
    private const ALLOWED_TAGS = [
        'p', 'br', 'strong', 'em', 'b', 'i', 'u',
        'ul', 'ol', 'li',
        'h1', 'h2', 'h3', 'h4', 'h5', 'h6',
        'blockquote', 'a',
    ];

    public static function sanitize(?string $html): string
    {
        if ($html === null || trim($html) === '') {
            return '';
        }

        $clean = (string) $html;

        // Supprime explicitement les blocs dangereux.
        $clean = preg_replace('#<\s*(script|style|iframe|object|embed|form|input|button|textarea|select)[^>]*>.*?<\s*/\s*\1\s*>#is', '', $clean) ?? $clean;
        $clean = preg_replace('#<\s*(script|style|iframe|object|embed|form|input|button|textarea|select)[^>]*/\s*>#is', '', $clean) ?? $clean;

        // Ne conserve que les balises éditoriales utiles côté CMS.
        $clean = strip_tags($clean, self::ALLOWED_TAGS);

        // Nettoie toutes les balises sauf <a> de leurs attributs.
        $clean = preg_replace('/<(?!\/?a\b)([a-z0-9]+)\b[^>]*>/i', '<$1>', $clean) ?? $clean;

        // Ne garde sur <a> que les attributs sûrs.
        $clean = preg_replace_callback('/<a\b([^>]*)>/i', function (array $m): string {
            $rawAttrs = $m[1] ?? '';
            $href = null;
            $target = null;
            $rel = null;

            if (preg_match_all('/([a-zA-Z_:][a-zA-Z0-9:._-]*)\s*=\s*("([^"]*)"|\'([^\']*)\'|([^\s"\'>]+))/u', $rawAttrs, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $attr) {
                    $name = strtolower($attr[1]);
                    $value = $attr[3] !== '' ? $attr[3] : ($attr[4] !== '' ? $attr[4] : $attr[5]);
                    $value = trim(html_entity_decode($value, ENT_QUOTES | ENT_HTML5, 'UTF-8'));

                    if ($name === 'href') {
                        $lower = strtolower($value);
                        $isAllowedHref = str_starts_with($lower, 'http://')
                            || str_starts_with($lower, 'https://')
                            || str_starts_with($lower, 'mailto:')
                            || str_starts_with($lower, 'tel:')
                            || str_starts_with($value, '/')
                            || str_starts_with($value, '#');
                        if ($isAllowedHref) {
                            $href = $value;
                        }
                    } elseif ($name === 'target') {
                        if (in_array($value, ['_blank', '_self'], true)) {
                            $target = $value;
                        }
                    } elseif ($name === 'rel') {
                        $rel = $value;
                    }
                }
            }

            $attrs = [];
            if ($href !== null) {
                $attrs[] = 'href="'.htmlspecialchars($href, ENT_QUOTES | ENT_HTML5, 'UTF-8').'"';
            }
            if ($target !== null) {
                $attrs[] = 'target="'.htmlspecialchars($target, ENT_QUOTES | ENT_HTML5, 'UTF-8').'"';
                if ($target === '_blank') {
                    $rel = 'noopener noreferrer';
                }
            }
            if ($rel !== null && $rel !== '') {
                $attrs[] = 'rel="'.htmlspecialchars($rel, ENT_QUOTES | ENT_HTML5, 'UTF-8').'"';
            }

            return '<a'.(! empty($attrs) ? ' '.implode(' ', $attrs) : '').'>';
        }, $clean) ?? $clean;

        return trim($clean);
    }
}
