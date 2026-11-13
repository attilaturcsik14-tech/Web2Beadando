<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mozi extends Model
{
    protected $table = 'mozik';
    public $timestamps = false;

    protected $fillable = ['nev', 'irszam', 'cim', 'telefon'];

    public function filmek()
    {
        return $this->belongsToMany(Film::class, 'vetitesek', 'mozi_id', 'film_id');
    }
}
