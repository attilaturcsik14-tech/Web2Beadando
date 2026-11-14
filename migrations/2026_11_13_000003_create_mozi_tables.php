<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('filmek', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filmcim', 150);
            $table->boolean('szines')->default(true);
            $table->string('szinkron', 30)->nullable();   // fel = feliratos, mb = magyarul beszélő
            $table->string('szarmazas', 80)->nullable();
            $table->string('mufaj', 50)->nullable();
            $table->unsignedSmallInteger('hossz');          // percben
        });

        Schema::create('mozik', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nev', 100);
            $table->string('irszam', 10);
            $table->string('cim', 100);
            $table->string('telefon', 30)->nullable();
        });

        // Kapcsolótábla: melyik filmet melyik moziban játsszák
        Schema::create('vetitesek', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('film_id');
            $table->unsignedInteger('mozi_id');
            $table->unique(['film_id', 'mozi_id']);
            $table->foreign('film_id')->references('id')->on('filmek')->onDelete('cascade');
            $table->foreign('mozi_id')->references('id')->on('mozik')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vetitesek');
        Schema::dropIfExists('mozik');
        Schema::dropIfExists('filmek');
    }
};
