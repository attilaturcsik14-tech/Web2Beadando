<x-layout title="Főoldal">
    <div class="p-5 mb-4 bg-primary text-white rounded-3">
        <h1 class="display-5 fw-bold">Moziműsor</h1>
        <p class="fs-5">Budapesti mozik és a bennük látható filmek egy helyen. Nézze meg, melyik filmet hol vetítik, böngésszen műfaj szerint, vagy írjon nekünk!</p>
        <a class="btn btn-light btn-lg me-2" href="{{ route('adatbazis') }}">Filmek megtekintése</a>
        <a class="btn btn-outline-light btn-lg" href="{{ route('contact') }}">Írjon nekünk</a>
    </div>

    <div class="row text-center g-3 mb-4">
        <div class="col-md-4">
            <div class="card h-100"><div class="card-body">
                <div class="display-6 text-primary">{{ $filmDb }}</div>
                <div class="text-muted">film a műsorban</div>
            </div></div>
        </div>
        <div class="col-md-4">
            <div class="card h-100"><div class="card-body">
                <div class="display-6 text-primary">{{ $moziDb }}</div>
                <div class="text-muted">mozi</div>
            </div></div>
        </div>
        <div class="col-md-4">
            <div class="card h-100"><div class="card-body">
                <div class="display-6 text-primary">{{ $mufajDb }}</div>
                <div class="text-muted">különböző műfaj</div>
            </div></div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <h2 class="h4">Filmek és mozik</h2>
            <p>Az Adatbázis menüben műfaj szerint szűrheti a filmeket, és minden filmnél látja, mely mozikban játsszák.</p>
        </div>
        <div class="col-md-6">
            <h2 class="h4">Statisztika</h2>
            <p>A Diagram menüben megnézheti a műfajok megoszlását, a legtöbb filmet játszó mozikat és az átlagos filmhosszt.</p>
        </div>
    </div>
</x-layout>
