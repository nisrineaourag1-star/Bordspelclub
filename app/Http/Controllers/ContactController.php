<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormSubmitted;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Toon het contactformulier.
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Verwerk het contactformulier: opslaan + e-mail naar admin.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        $contactMessage = ContactMessage::create($validated);

        Mail::to(config('mail.admin_address', 'admin@ehb.be'))
            ->send(new ContactFormSubmitted($contactMessage));

        return redirect()->route('contact.create')->with('status', 'Je bericht is verstuurd, bedankt!');
    }
}