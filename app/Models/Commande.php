<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Commande extends Model
{
    protected $table = 'commandes';

    protected $fillable = [
        'reference', 'nom', 'email', 'telephone',
        'adresse', 'notes', 'total', 'statut',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    public static array $statuts = [
        'en_attente'    => 'En attente',
        'confirmee'     => 'Confirmée',
        'en_preparation'=> 'En préparation',
        'livree'        => 'Livrée',
        'annulee'       => 'Annulée',
    ];

    public static array $statutColors = [
        'en_attente'    => 'warning',
        'confirmee'     => 'info',
        'en_preparation'=> 'primary',
        'livree'        => 'success',
        'annulee'       => 'danger',
    ];

    public function lignes(): HasMany
    {
        return $this->hasMany(CommandeLigne::class, 'commande_id');
    }

    public function getStatutLabelAttribute(): string
    {
        return self::$statuts[$this->statut] ?? $this->statut;
    }

    public function getStatutColorAttribute(): string
    {
        return self::$statutColors[$this->statut] ?? 'secondary';
    }

    public static function genererReference(): string
    {
        do {
            $ref = 'CMD-' . strtoupper(Str::random(8));
        } while (static::where('reference', $ref)->exists());

        return $ref;
    }

    public function scopeRecentes($query)
    {
        return $query->orderByDesc('created_at');
    }
}
