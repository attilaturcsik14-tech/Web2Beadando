<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        // Szerver oldali validáció
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email|max:150',
            'subject' => 'required|string|min:3|max:150',
            'message' => 'required|string|min:10|max:2000',
        ], [
            'name.required' => 'A név megadása kötelező.',
            'name.min' => 'A név legalább 3 karakter legyen.',
            'email.required' => 'Az e-mail cím megadása kötelező.',
            'email.email' => 'Érvényes e-mail címet adjon meg.',
            'subject.required' => 'A tárgy megadása kötelező.',
            'subject.min' => 'A tárgy legalább 3 karakter legyen.',
            'message.required' => 'Az üzenet megadása kötelező.',
            'message.min' => 'Az üzenet legalább 10 karakter legyen.',
        ]);

        Message::create($validated); // mentés az adatbázisba

        return redirect()->route('contact')->with('success', 'Köszönjük, az üzenetet elmentettük!');
    }
}
