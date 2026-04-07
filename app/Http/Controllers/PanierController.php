<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class PanierController extends Controller
{
    /** Retourne le panier depuis la session. */
    public static function panier(): array
    {
        return session('panier', []);
    }

    /** Nombre total d'articles dans le panier. */
    public static function count(): int
    {
        return array_sum(array_column(session('panier', []), 'quantite'));
    }

    /** Page du panier. */
    public function index()
    {
        $panier = self::panier();
        $total  = array_sum(array_map(fn ($l) => $l['prix'] * $l['quantite'], $panier));

        return view('panier', compact('panier', 'total'));
    }

    /** Ajouter ou incrémenter un produit. */
    public function ajouter(Request $request, Produit $produit)
    {
        $request->validate(['quantite' => 'required|integer|min:1|max:99']);

        if (! $produit->is_active) {
            return back()->with('error', 'Ce produit n\'est plus disponible.');
        }

        if ($produit->stock !== null && $produit->stock <= 0) {
            return back()->with('error', 'Ce produit est épuisé.');
        }

        $panier = self::panier();
        $id     = $produit->id;
        $qte    = (int) $request->quantite;

        if (isset($panier[$id])) {
            $panier[$id]['quantite'] = min($panier[$id]['quantite'] + $qte, 99);
        } else {
            $panier[$id] = [
                'id'        => $produit->id,
                'nom'       => $produit->nom,
                'reference' => $produit->reference,
                'prix'      => (float) $produit->prix,
                'image'     => $produit->image,
                'quantite'  => $qte,
            ];
        }

        session(['panier' => $panier]);

        return back()->with('success', '"' . $produit->nom . '" ajouté au panier.');
    }

    /** Modifier la quantité d'un article. */
    public function mettreAJour(Request $request, int $produitId)
    {
        $request->validate(['quantite' => 'required|integer|min:1|max:99']);

        $panier = self::panier();

        if (isset($panier[$produitId])) {
            $panier[$produitId]['quantite'] = (int) $request->quantite;
            session(['panier' => $panier]);
        }

        return back()->with('success', 'Panier mis à jour.');
    }

    /** Supprimer un article du panier. */
    public function supprimer(int $produitId)
    {
        $panier = self::panier();
        unset($panier[$produitId]);
        session(['panier' => $panier]);

        return back()->with('success', 'Article retiré du panier.');
    }

    /** Vider le panier. */
    public function vider()
    {
        session()->forget('panier');

        return back()->with('success', 'Panier vidé.');
    }
}
