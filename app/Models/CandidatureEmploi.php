<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CandidatureEmploi extends Model
{
    protected $table = 'candidatures_emploi';

    protected $fillable = [
        'offre_emploi_id',
        'prenom',
        'nom',
        'email',
        'telephone',
        'message',
        'lettre_motivation',
        'cv_path',
    ];

    public function offre(): BelongsTo
    {
        return $this->belongsTo(OffreEmploi::class, 'offre_emploi_id');
    }
}
