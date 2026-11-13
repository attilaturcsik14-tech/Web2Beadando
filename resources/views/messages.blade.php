<x-layout title="Üzenetek">
    <h1 class="mb-4">Üzenetek</h1>
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th>Küldés ideje</th>
                    <th>Név</th>
                    <th>E-mail</th>
                    <th>Tárgy</th>
                    <th>Üzenet</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $m)
                    <tr>
                        <td class="text-nowrap">{{ $m->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $m->name }}</td>
                        <td>{{ $m->email }}</td>
                        <td>{{ $m->subject }}</td>
                        <td>{{ $m->message }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">Még nincs üzenet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layout>
