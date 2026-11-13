<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'filmek';
    public $timestamps = false;

    protected $fillable = ['filmcim', 'szines', 'szinkron', 'szarmazas', 'mufaj', 'hossz'];

    protected $casts = ['szines' => 'boolean'];

    // Több-a-többhöz kapcsolat a vetitesek táblán keresztül
    public function mozik()
    {
        return $this->belongsToMany(Mozi::class, 'vetitesek', 'film_id', 'mozi_id');
    }

    // fel = feliratos, mb = magyarul beszélő
    public function getSzinkronSzovegAttribute(): string
    {
        return match ($this->szinkron) {
            'fel' => 'feliratos',
            'mb' => 'magyarul beszélő',
            null, '' => '-',
            default => $this->szinkron,
        };
    }
}
