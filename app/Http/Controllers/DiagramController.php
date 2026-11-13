<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Mozi;
use Illuminate\Support\Facades\DB;

class DiagramController extends Controller
{
    public function index()
    {
        // 1. Filmek száma műfajonként
        $mufajok = Film::select('mufaj', DB::raw('count(*) as db'))
            ->whereNotNull('mufaj')
            ->groupBy('mufaj')
            ->orderByDesc('db')
            ->limit(10)
            ->get();

        // 2. A 10 legtöbb filmet játszó mozi (mozik + vetitesek tábla)
        $mozik = Mozi::withCount('filmek')
            ->orderByDesc('filmek_count')
            ->orderBy('nev')
            ->limit(10)
            ->get();

        // 3. Átlagos hossz műfajonként (legalább 3 filmes műfajok)
        $hosszak = Film::select('mufaj', DB::raw('round(avg(hossz)) as atlag'))
            ->whereNotNull('mufaj')
            ->groupBy('mufaj')
            ->havingRaw('count(*) >= 3')
            ->orderBy('mufaj')
            ->get();

        return view('diagram', compact('mufajok', 'mozik', 'hosszak'));
    }
}
