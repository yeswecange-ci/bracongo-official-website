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
        'maintenance_active', 'maintenance_titre', 'maintenance_message',
        'actualites_hero_titre', 'actualites_filtre_tout_label',
        'invitation_expires_hours',
        'contact_reply_closing',
        'commande_statut_email_sujet',
        'commande_statut_email_corps_html',
    ];

    protected function casts(): array
    {
        return [
            'invitation_expires_hours' => InvitationExpiresHours::class,
            'maintenance_active' => 'boolean',
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

    public static function defaultCommandeStatutEmailSubjectTemplate(): string
    {
        return 'Commande {reference} — {nouveau_statut}';
    }

    public static function defaultCommandeStatutEmailCorpsHtmlTemplate(): string
    {
        return <<<'HTML'
<p style="margin:0 0 16px;">Bonjour {nom_client},</p>
<p style="margin:0 0 16px;">
    Le statut de votre commande <strong>{reference}</strong> a été mis à jour.
</p>
<p style="margin:0 0 8px;">
    <span style="color:#64748b;">Ancien statut :</span> {ancien_statut}
</p>
<p style="margin:0 0 20px;">
    <span style="color:#64748b;">Nouveau statut :</span> <strong>{nouveau_statut}</strong>
</p>
<p style="margin:0;font-size:13px;color:#64748b;">
    Si vous n’êtes pas à l’origine de cette commande, vous pouvez ignorer ce message.
</p>
HTML;
    }

    /**
     * Sujet d’e-mail (texte brut) après substitution des variables.
     */
    public function resolvedCommandeStatutEmailSubject(
        string $nomClient,
        string $reference,
        string $ancienStatut,
        string $nouveauStatut,
    ): string {
        $tpl = trim((string) $this->commande_statut_email_sujet);

        if ($tpl === '') {
            $tpl = self::defaultCommandeStatutEmailSubjectTemplate();
        }

        return $this->replaceCommandeStatutEmailPlaceholders($tpl, $nomClient, $reference, $ancienStatut, $nouveauStatut, false);
    }

    /**
     * Corps HTML (fragment) après substitution des variables (données échappées).
     */
    public function resolvedCommandeStatutEmailCorpsHtml(
        string $nomClient,
        string $reference,
        string $ancienStatut,
        string $nouveauStatut,
    ): string {
        $tpl = trim((string) $this->commande_statut_email_corps_html);

        if ($tpl === '') {
            $tpl = self::defaultCommandeStatutEmailCorpsHtmlTemplate();
        }

        return $this->replaceCommandeStatutEmailPlaceholders($tpl, $nomClient, $reference, $ancienStatut, $nouveauStatut, true);
    }

    private function replaceCommandeStatutEmailPlaceholders(
        string $template,
        string $nomClient,
        string $reference,
        string $ancienStatut,
        string $nouveauStatut,
        bool $forHtml,
    ): string {
        $nomSite = (string) config('app.name', 'Bracongo');

        if ($forHtml) {
            $map = [
                '{nom_client}' => e($nomClient),
                '{reference}' => e($reference),
                '{ancien_statut}' => e($ancienStatut),
                '{nouveau_statut}' => e($nouveauStatut),
                '{nom_site}' => e($nomSite),
            ];
        } else {
            $esc = static fn (string $s): string => str_replace(["\r", "\n"], '', htmlspecialchars($s, ENT_QUOTES, 'UTF-8'));

            $map = [
                '{nom_client}' => $esc($nomClient),
                '{reference}' => $esc($reference),
                '{ancien_statut}' => $esc($ancienStatut),
                '{nouveau_statut}' => $esc($nouveauStatut),
                '{nom_site}' => $esc($nomSite),
            ];
        }

        return str_replace(array_keys($map), array_values($map), $template);
    }
}
