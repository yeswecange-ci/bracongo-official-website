<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FaqQuestion extends Model
{
    protected $table = 'faq_questions';

    protected $fillable = ['faq_section_id', 'question', 'reponse', 'ordre', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(FaqSection::class, 'faq_section_id');
    }

    /**
     * Réponse prête à l'affichage : les balises de personnalisation saisies au
     * back-office sont remplacées par les valeurs des paramètres du site.
     *
     * @param  array<string, string|null>  $valeurs
     */
    public function reponseRendue(array $valeurs = []): string
    {
        $remplacements = [];
        foreach ($valeurs as $cle => $valeur) {
            $remplacements['{'.$cle.'}'] = (string) ($valeur ?? '');
        }

        return strtr($this->reponse, $remplacements);
    }
}
