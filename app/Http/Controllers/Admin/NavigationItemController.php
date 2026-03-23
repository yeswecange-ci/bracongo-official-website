<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavigationItem;
use Illuminate\Http\Request;

class NavigationItemController extends Controller
{
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

    public function edit(NavigationItem $navigationItem)
    {
        $parents = NavigationItem::parents()->where('id', '!=', $navigationItem->id)->get();
        return view('admin.navigation.edit', compact('navigationItem', 'parents'));
    }

    public function update(Request $request, NavigationItem $navigationItem)
    {
        $data = $request->validate([
            'label'     => 'required|string|max:255',
            'url'       => 'nullable|string|max:255',
            'ordre'     => 'nullable|integer|min:0',
            'parent_id' => 'nullable|exists:navigation_items,id',
            'is_active' => 'nullable|boolean',
        ]);
        $data['is_active'] = $request->boolean('is_active');

        $navigationItem->update($data);

        return redirect()->route('admin.navigation.index')
            ->with('success', 'Item mis à jour.');
    }

    public function destroy(NavigationItem $navigationItem)
    {
        $navigationItem->delete();
        return redirect()->route('admin.navigation.index')
            ->with('success', 'Item supprimé.');
    }
}
