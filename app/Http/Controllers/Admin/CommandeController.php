<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\CommandeStatutMisAJour;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommandeController extends Controller
{
    public function index(Request $request)
    {
        $query = Commande::with('lignes')->recentes();

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qb) use ($q) {
                $qb->where('reference', 'like', "%{$q}%")
                   ->orWhere('nom', 'like', "%{$q}%")
                   ->orWhere('email', 'like', "%{$q}%");
            });
        }

        $commandes = $query->paginate(20)->withQueryString();
        $statuts   = Commande::$statuts;
        $counts    = Commande::selectRaw('statut, count(*) as total')->groupBy('statut')->pluck('total', 'statut');

        return view('admin.commandes.index', compact('commandes', 'statuts', 'counts'));
    }

    public function show(Commande $commande)
    {
        $commande->load('lignes.produit');
        $statuts = Commande::$statuts;

        return view('admin.commandes.show', compact('commande', 'statuts'));
    }

    public function updateStatut(Request $request, Commande $commande)
    {
        $request->validate([
            'statut' => 'required|in:' . implode(',', array_keys(Commande::$statuts)),
        ]);

        $ancien = $commande->statut;
        $nouveau = $request->statut;

        if ($ancien === $nouveau) {
            return back()->with('success', 'Le statut est déjà « ' . Commande::$statuts[$ancien] . ' ».');
        }

        $ancienLibelle = Commande::$statuts[$ancien] ?? $ancien;
        $nouveauLibelle = Commande::$statuts[$nouveau] ?? $nouveau;

        $commande->update(['statut' => $nouveau]);

        if (filled($commande->email)) {
            try {
                Mail::to($commande->email)->send(
                    new CommandeStatutMisAJour($commande->fresh(), $ancienLibelle, $nouveauLibelle)
                );
            } catch (\Throwable $e) {
                report($e);

                return back()->with('warning', 'Statut mis à jour : ' . $nouveauLibelle . '. L’envoi de l’e-mail de notification a échoué ; vérifiez la configuration mail.');
            }
        }

        $suffix = filled($commande->email)
            ? '. Un e-mail de confirmation a été envoyé au client.'
            : ' (aucune adresse e-mail renseignée sur la commande).';

        return back()->with('success', 'Statut mis à jour : ' . $nouveauLibelle . $suffix);
    }

    public function destroy(Commande $commande)
    {
        $commande->delete();

        return redirect()->route('admin.commandes.index')->with('success', 'Commande supprimée.');
    }
}
