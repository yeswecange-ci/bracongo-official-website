<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqQuestion;
use App\Models\FaqSection;
use Illuminate\Http\Request;

class FaqQuestionController extends Controller
{
    public function create(Request $request)
    {
        $sections = FaqSection::orderBy('ordre')->get();

        if ($sections->isEmpty()) {
            return redirect()->route('admin.faq.index')
                ->with('error', 'Créez d\'abord une rubrique avant d\'ajouter une question.');
        }

        return view('admin.faq.questions.create', [
            'sections' => $sections,
            'sectionSelectionnee' => $request->integer('section') ?: $sections->first()->id,
        ]);
    }

    public function store(Request $request)
    {
        FaqQuestion::create($this->validated($request));

        return redirect()->route('admin.faq.index')->with('success', 'Question ajoutée.');
    }

    public function edit(FaqQuestion $faqQuestion)
    {
        return view('admin.faq.questions.edit', [
            'question' => $faqQuestion,
            'sections' => FaqSection::orderBy('ordre')->get(),
        ]);
    }

    public function update(Request $request, FaqQuestion $faqQuestion)
    {
        $faqQuestion->update($this->validated($request));

        return redirect()->route('admin.faq.index')->with('success', 'Question mise à jour.');
    }

    public function destroy(FaqQuestion $faqQuestion)
    {
        $faqQuestion->delete();

        return redirect()->route('admin.faq.index')->with('success', 'Question supprimée.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        $data = $request->validate([
            'faq_section_id' => 'required|exists:faq_sections,id',
            'question' => 'required|string|max:255',
            'reponse' => 'required|string|max:5000',
            'ordre' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ], [
            'faq_section_id.required' => 'Sélectionnez la rubrique dans laquelle ranger cette question.',
            'question.required' => 'La question est obligatoire.',
            'question.max' => 'La question ne doit pas dépasser 255 caractères.',
            'reponse.required' => 'La réponse est obligatoire.',
        ]);

        $data['ordre'] = $data['ordre'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
