<?php

namespace App\Models;

use App\Enums\InvitationExpiresHours;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ParametresSite extends Model
{
    protected $table = 'parametres_site';

    protected $fillable = [
        'logo', 'favicon', 'couleur_principale', 'search_suggestions',
        'seo_meta_description', 'telephone_public',
        'actualites_hero_titre', 'actualites_filtre_tout_label',
        'invitation_expires_hours',
        'contact_reply_closing',
    ];

    protected function casts(): array
    {
        return [
            'invitation_expires_hours' => InvitationExpiresHours::class,
        ];
    }

    protected static function booted(): void
    {
        $flush = fn () => Cache::forget('front.parametres');
        static::saved($flush);
        static::deleted($flush);
    }

    public static function instance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }

    public static function defaultContactReplyClosing(): string
    {
        $name = config('app.name', 'Bracongo');

        return "Cordialement,\n\nL'équipe {$name}";
    }

    /**
     * Texte affiché comme placeholder dans la barre de recherche du site public (même valeur que les suggestions BO).
     */
    public function resolvedSearchPlaceholder(): string
    {
        $s = trim((string) ($this->search_suggestions ?? ''));

        return $s !== '' ? $s : 'Rechercher sur le site…';
    }

    public function resolvedContactReplyClosing(): string
    {
        $raw = $this->contact_reply_closing;

        if ($raw === null || trim($raw) === '') {
            return self::defaultContactReplyClosing();
        }

        return trim($raw);
    }
}
