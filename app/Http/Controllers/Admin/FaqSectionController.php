<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqSection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FaqSectionController extends Controller
{
    public function index()
    {
        $sections = FaqSection::with('questions')->orderBy('ordre')->get();

        return view('admin.faq.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.faq.sections.create');
    }

    public function store(Request $request)
    {
        FaqSection::create($this->validated($request));

        return redirect()->route('admin.faq.index')->with('success', 'Rubrique ajoutée.');
    }

    public function edit(FaqSection $faqSection)
    {
        return view('admin.faq.sections.edit', ['section' => $faqSection]);
    }

    public function update(Request $request, FaqSection $faqSection)
    {
        $faqSection->update($this->validated($request));

        return redirect()->route('admin.faq.index')->with('success', 'Rubrique mise à jour.');
    }

    public function destroy(FaqSection $faqSection)
    {
        // Les questions rattachées partent avec la rubrique (cascade en base).
        $faqSection->delete();

        return redirect()->route('admin.faq.index')->with('success', 'Rubrique supprimée.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'icone' => ['required', Rule::in(array_keys(FaqSection::ICONES))],
            'ordre' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ], [
            'titre.required' => 'Le titre de la rubrique est obligatoire.',
            'icone.required' => 'Choisissez une icône pour la rubrique.',
            'icone.in' => 'Choisissez une icône dans la liste proposée.',
        ]);

        $data['ordre'] = $data['ordre'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
