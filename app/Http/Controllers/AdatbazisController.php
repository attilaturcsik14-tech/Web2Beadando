<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class AdatbazisController extends Controller
{
    public function index(Request $request)
    {
        $mufaj = $request->query('mufaj');

        // ORM + kapcsolat: filmek (filmek tábla) a vetítő mozikkal (mozik, vetitesek táblák)
        $filmek = Film::with('mozik')
            ->when($mufaj, fn ($q) => $q->where('mufaj', $mufaj))
            ->orderBy('filmcim')
            ->get();

        $mufajok = Film::whereNotNull('mufaj')->distinct()->orderBy('mufaj')->pluck('mufaj');

        return view('adatbazis', compact('filmek', 'mufajok', 'mufaj'));
    }
}
