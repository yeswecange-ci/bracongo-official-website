<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\CommandeLigne;
use Illuminate\Http\Request;

class CommandeFrontController extends Controller
{
    /** Formulaire de commande (checkout). */
    public function checkout()
    {
        $panier = PanierController::panier();

        if (empty($panier)) {
            return redirect()->route('panier')->with('error', 'Votre panier est vide.');
        }

        $total = array_sum(array_map(fn ($l) => $l['prix'] * $l['quantite'], $panier));

        return view('commande-checkout', compact('panier', 'total'));
    }

    /** Enregistrer la commande. */
    public function store(Request $request)
    {
        $panier = PanierController::panier();

        if (empty($panier)) {
            return redirect()->route('boutique')->with('error', 'Votre panier est vide.');
        }

        $data = $request->validate([
            'nom'       => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'telephone' => 'nullable|string|max:50',
            'adresse'   => 'nullable|string|max:500',
            'notes'     => 'nullable|string|max:1000',
        ]);

        $total = array_sum(array_map(fn ($l) => $l['prix'] * $l['quantite'], $panier));

        $commande = Commande::create([
            'reference' => Commande::genererReference(),
            'nom'       => $data['nom'],
            'email'     => $data['email'],
            'telephone' => $data['telephone'] ?? null,
            'adresse'   => $data['adresse'] ?? null,
            'notes'     => $data['notes'] ?? null,
            'total'     => $total,
            'statut'    => 'en_attente',
        ]);

        foreach ($panier as $ligne) {
            CommandeLigne::create([
                'commande_id'       => $commande->id,
                'produit_id'        => $ligne['id'],
                'nom_produit'       => $ligne['nom'],
                'reference_produit' => $ligne['reference'] ?? null,
                'prix_unitaire'     => $ligne['prix'],
                'quantite'          => $ligne['quantite'],
                'sous_total'        => $ligne['prix'] * $ligne['quantite'],
            ]);
        }

        session()->forget('panier');

        return redirect()->route('commande.confirmation', $commande->reference);
    }

    /** Page de confirmation. */
    public function confirmation(string $reference)
    {
        $commande = Commande::with('lignes')
            ->where('reference', $reference)
            ->firstOrFail();

        return view('commande-confirmation', compact('commande'));
    }
}
