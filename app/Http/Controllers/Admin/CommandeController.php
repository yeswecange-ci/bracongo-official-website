<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use Illuminate\Http\Request;

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

        $commande->update(['statut' => $request->statut]);

        return back()->with('success', 'Statut mis à jour : ' . Commande::$statuts[$request->statut]);
    }

    public function destroy(Commande $commande)
    {
        $commande->delete();

        return redirect()->route('admin.commandes.index')->with('success', 'Commande supprimée.');
    }
}
