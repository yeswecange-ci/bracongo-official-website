<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommandeLigne extends Model
{
    protected $table = 'commande_lignes';

    protected $fillable = [
        'commande_id', 'produit_id', 'nom_produit',
        'reference_produit', 'prix_unitaire', 'quantite', 'sous_total',
    ];

    protected $casts = [
        'prix_unitaire' => 'decimal:2',
        'sous_total'    => 'decimal:2',
        'quantite'      => 'integer',
    ];

    public function commande(): BelongsTo
    {
        return $this->belongsTo(Commande::class, 'commande_id');
    }

    public function produit(): BelongsTo
    {
        return $this->belongsTo(Produit::class, 'produit_id');
    }
}
