<x-layout title="Filmek kezelése">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Filmek kezelése</h1>
        <a href="{{ route('filmek.create') }}" class="btn btn-primary">Új film</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr><th>#</th><th>Cím</th><th>Műfaj</th><th>Származás</th><th>Hossz</th><th class="text-end">Műveletek</th></tr>
            </thead>
            <tbody>
                @foreach ($filmek as $f)
                    <tr>
                        <td>{{ $f->id }}</td>
                        <td>{{ $f->filmcim }}</td>
                        <td>{{ $f->mufaj ?? '-' }}</td>
                        <td>{{ $f->szarmazas ?? '-' }}</td>
                        <td class="text-nowrap">{{ $f->hossz }} perc</td>
                        <td class="text-end text-nowrap">
                            <a href="{{ route('filmek.edit', $f) }}" class="btn btn-sm btn-outline-primary">Szerkesztés</a>
                            <form method="POST" action="{{ route('filmek.destroy', $f) }}" class="d-inline" onsubmit="return confirm('Biztosan törli ezt a filmet?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Törlés</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
