<x-layout title="Adatbázis">
    <h1 class="mb-3">Filmek</h1>

    <form method="GET" action="{{ route('adatbazis') }}" class="row g-2 align-items-end mb-3">
        <div class="col-auto">
            <label for="mufaj" class="form-label">Műfaj szerinti szűrés</label>
            <select id="mufaj" name="mufaj" class="form-select">
                <option value="">Összes</option>
                @foreach ($mufajok as $m)
                    <option value="{{ $m }}" @selected($m === $mufaj)>{{ $m }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Szűrés</button>
        </div>
    </form>

    <p class="text-muted">{{ $filmek->count() }} film.</p>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th>Cím</th>
                    <th>Műfaj</th>
                    <th>Származás</th>
                    <th>Hossz</th>
                    <th>Nyelv</th>
                    <th>Mozik, ahol játsszák</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($filmek as $f)
                    <tr>
                        <td>{{ $f->filmcim }}</td>
                        <td>{{ $f->mufaj ?? '-' }}</td>
                        <td>{{ $f->szarmazas ?? '-' }}</td>
                        <td class="text-nowrap">{{ $f->hossz }} perc</td>
                        <td>{{ $f->szinkron_szoveg }}</td>
                        <td>
                            @foreach ($f->mozik as $mozi)
                                <span class="badge bg-secondary">{{ $mozi->nev }}</span>
                            @endforeach
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted">Nincs találat.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>
