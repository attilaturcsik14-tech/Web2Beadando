<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Mozi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoziSeeder extends Seeder
{
    /** Beolvassa a tabulátorral tagolt forrásfájlt (az első sor a fejléc). */
    private function beolvas(string $fajl): array
    {
        $sorok = file(__DIR__ . '/data/' . $fajl, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $fejlec = explode("\t", trim(array_shift($sorok), "\xEF\xBB\xBF\r\n"));
        $eredmeny = [];
        foreach ($sorok as $sor) {
            $mezok = explode("\t", rtrim($sor, "\r\n"));
            $eredmeny[] = array_combine($fejlec, array_pad($mezok, count($fejlec), ''));
        }
        return $eredmeny;
    }

    private function nullHaUres(string $ertek): ?string
    {
        $ertek = trim($ertek);
        return $ertek === '' ? null : $ertek;
    }

    public function run(): void
    {
        $filmek = array_map(fn ($r) => [
            'id' => (int) $r['fkod'],
            'filmcim' => trim($r['filmcim']),
            // a forrásban az igaz érték -1 (Access logikai mező)
            'szines' => in_array(trim($r['szines']), ['-1', '1'], true),
            'szinkron' => $this->nullHaUres($r['szinkron']),
            'szarmazas' => $this->nullHaUres($r['szarmazas']),
            'mufaj' => $this->nullHaUres($r['mufaj']),
            'hossz' => (int) $r['hossz'],
        ], $this->beolvas('film.txt'));

        $mozik = array_map(fn ($r) => [
            'id' => (int) $r['moziazon'],
            'nev' => trim($r['mozinev']),
            'irszam' => trim($r['irszam']),
            'cim' => trim($r['cim']),
            'telefon' => $this->nullHaUres($r['telefon']),
        ], $this->beolvas('mozi.txt'));

        $vetitesek = array_map(fn ($r) => [
            'film_id' => (int) $r['fkod'],
            'mozi_id' => (int) $r['moziazon'],
        ], $this->beolvas('hely.txt'));

        Film::insert($filmek);
        Mozi::insert($mozik);
        DB::table('vetitesek')->insert($vetitesek);
    }
}
