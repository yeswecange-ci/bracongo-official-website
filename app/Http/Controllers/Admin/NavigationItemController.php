<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavigationItem;
use Illuminate\Http\Request;

class NavigationItemController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = $request->user();
            if (! $user || ! $user->isAdministration()) {
                abort(403, 'Accès réservé aux administrateurs.');
            }

            return $next($request);
        });
    }

    public function index()
    {
        $items = NavigationItem::with('enfants')->parents()->get();

        return view('admin.navigation.index', compact('items'));
    }

    public function create()
    {
        $parents = NavigationItem::parents()->get();

        return view('admin.navigation.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label'     => 'required|string|max:255',
            'url'       => 'nullable|string|max:255',
            'ordre'     => 'nullable|integer|min:0',
            'parent_id' => 'nullable|exists:navigation_items,id',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');

        NavigationItem::create($data);

        return redirect()->route('admin.navigation.index')
            ->with('success', 'Item de navigation ajouté.');
    }

    public function edit(NavigationItem $navigation)
    {
        $parents = NavigationItem::parents()->where('id', '!=', $navigation->id)->get();

        return view('admin.navigation.edit', compact('navigation', 'parents'));
    }

    public function update(Request $request, NavigationItem $navigation)
    {
        $data = $request->validate([
            'label'     => 'required|string|max:255',
            'url'       => 'nullable|string|max:255',
            'ordre'     => 'nullable|integer|min:0',
            'parent_id' => 'nullable|exists:navigation_items,id',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');

        $navigation->update($data);

        return redirect()->route('admin.navigation.index')
            ->with('success', 'Item mis à jour.');
    }

    public function destroy(NavigationItem $navigation)
    {
        $navigation->delete();

        return redirect()->route('admin.navigation.index')
            ->with('success', 'Item supprimé.');
    }
}
