<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    private function szabalyok(): array
    {
        return [
            'filmcim' => 'required|string|min:2|max:150',
            'szines' => 'nullable|boolean',
            'szinkron' => 'nullable|in:fel,mb',
            'szarmazas' => 'nullable|string|max:80',
            'mufaj' => 'nullable|string|max:50',
            'hossz' => 'required|integer|min:1|max:600',
        ];
    }

    private function uzenetek(): array
    {
        return [
            'filmcim.required' => 'A film címének megadása kötelező.',
            'filmcim.min' => 'A cím legalább 2 karakter legyen.',
            'hossz.required' => 'A hossz megadása kötelező.',
            'hossz.integer' => 'A hossz egész szám legyen (percben).',
            'hossz.min' => 'A hossz legalább 1 perc legyen.',
            'hossz.max' => 'A hossz legfeljebb 600 perc lehet.',
        ];
    }

    private function adatok(Request $request): array
    {
        $adatok = $request->validate($this->szabalyok(), $this->uzenetek());
        $adatok['szines'] = $request->boolean('szines');
        foreach (['szinkron', 'szarmazas', 'mufaj'] as $mezo) {
            $adatok[$mezo] = ($adatok[$mezo] ?? '') === '' ? null : $adatok[$mezo];
        }
        return $adatok;
    }

    // Read: lista
    public function index()
    {
        $filmek = Film::orderBy('id')->get();
        return view('filmek.index', compact('filmek'));
    }

    // Create: űrlap
    public function create()
    {
        return view('filmek.create');
    }

    // Create: mentés
    public function store(Request $request)
    {
        Film::create($this->adatok($request));

        return redirect()->route('filmek.index')->with('success', 'A filmet elmentettük.');
    }

    // Update: űrlap
    public function edit(Film $film)
    {
        return view('filmek.edit', compact('film'));
    }

    // Update: mentés
    public function update(Request $request, Film $film)
    {
        $film->update($this->adatok($request));

        return redirect()->route('filmek.index')->with('success', 'A filmet módosítottuk.');
    }

    // Delete
    public function destroy(Film $film)
    {
        $film->delete(); // a vetítések a külső kulcs miatt együtt törlődnek

        return redirect()->route('filmek.index')->with('success', 'A filmet töröltük.');
    }
}
