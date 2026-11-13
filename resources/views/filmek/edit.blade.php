<x-layout title="Film szerkesztése">
    <h1 class="mb-4">Film szerkesztése</h1>
    <div class="row"><div class="col-lg-7">
        <form method="POST" action="{{ route('filmek.update', $film) }}" novalidate>
            @method('PUT')
            @include('filmek._form')
        </form>
    </div></div>
</x-layout>
