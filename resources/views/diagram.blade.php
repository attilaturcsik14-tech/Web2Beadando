<x-layout title="Diagram">
    <h1 class="mb-4">Diagramok</h1>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card"><div class="card-body">
                <h2 class="h5">Filmek száma műfajonként</h2>
                <canvas id="mufajChart"></canvas>
            </div></div>
        </div>
        <div class="col-lg-6">
            <div class="card"><div class="card-body">
                <h2 class="h5">A legtöbb filmet játszó mozik</h2>
                <canvas id="moziChart"></canvas>
            </div></div>
        </div>
        <div class="col-12">
            <div class="card"><div class="card-body">
                <h2 class="h5">Átlagos filmhossz műfajonként (perc, legalább 3 filmes műfajok)</h2>
                <canvas id="hosszChart"></canvas>
            </div></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script>
        const mufajCimkek = @json($mufajok->pluck('mufaj'));
        const mufajAdatok = @json($mufajok->pluck('db'));
        const moziCimkek = @json($mozik->pluck('nev'));
        const moziAdatok = @json($mozik->pluck('filmek_count'));
        const hosszCimkek = @json($hosszak->pluck('mufaj'));
        const hosszAdatok = @json($hosszak->pluck('atlag'));

        new Chart(document.getElementById('mufajChart'), {
            type: 'doughnut',
            data: { labels: mufajCimkek, datasets: [{ data: mufajAdatok }] }
        });

        new Chart(document.getElementById('moziChart'), {
            type: 'bar',
            data: { labels: moziCimkek, datasets: [{ label: 'Filmek száma', data: moziAdatok, backgroundColor: '#18bc9c' }] },
            options: { indexAxis: 'y', plugins: { legend: { display: false } }, scales: { x: { beginAtZero: true } } }
        });

        new Chart(document.getElementById('hosszChart'), {
            type: 'bar',
            data: { labels: hosszCimkek, datasets: [{ label: 'Átlagos hossz (perc)', data: hosszAdatok, backgroundColor: '#2c3e50' }] },
            options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
        });
    </script>
</x-layout>
