<?php

namespace App\Models;

use App\Enums\InvitationExpiresHours;
use Illuminate\Database\Eloquent\Model;

class ParametresSite extends Model
{
    protected $table = 'parametres_site';

    protected $fillable = [
        'logo', 'favicon', 'couleur_principale', 'search_suggestions',
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

    public static function instance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }

    /**
     * Formule de politesse par défaut pour les réponses aux messages de contact (e-mail).
     */
    public static function defaultContactReplyClosing(): string
    {
        $name = config('app.name', 'Bracongo');

        return "Cordialement,\n\nL'équipe {$name}";
    }

    /**
     * Texte affiché en pied de réponse e-mail (paramètre ou défaut).
     */
    public function resolvedContactReplyClosing(): string
    {
        $raw = $this->contact_reply_closing;

        if ($raw === null || trim($raw) === '') {
            return self::defaultContactReplyClosing();
        }

        return trim($raw);
    }
}
