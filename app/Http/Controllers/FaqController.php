<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use App\Models\FaqItem;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Publieke FAQ-pagina, gegroepeerd per categorie.
     */
    public function index()
    {
        $categories = FaqCategory::with('items')->get();

        return view('faq.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Beheerpagina voor admins: categorieën en items toevoegen/verwijderen.
     */
    public function manage()
    {
        $categories = FaqCategory::with('items')->get();

        return view('faq.manage', [
            'categories' => $categories,
        ]);
    }

    /**
     * Nieuwe categorie toevoegen.
     */
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        FaqCategory::create($validated);

        return redirect()->route('faq.manage')->with('status', 'Categorie toegevoegd.');
    }

    /**
     * Categorie verwijderen (verwijdert ook de items erin, via cascade).
     */
    public function destroyCategory(FaqCategory $faqCategory)
    {
        $faqCategory->delete();

        return redirect()->route('faq.manage')->with('status', 'Categorie verwijderd.');
    }

    /**
     * Nieuwe vraag/antwoord toevoegen aan een categorie.
     */
    public function storeItem(Request $request)
    {
        $validated = $request->validate([
            'faq_category_id' => ['required', 'exists:faq_categories,id'],
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
        ]);

        FaqItem::create($validated);

        return redirect()->route('faq.manage')->with('status', 'Vraag toegevoegd.');
    }

    /**
     * Vraag/antwoord verwijderen.
     */
    public function destroyItem(FaqItem $faqItem)
    {
        $faqItem->delete();

        return redirect()->route('faq.manage')->with('status', 'Vraag verwijderd.');
    }
}