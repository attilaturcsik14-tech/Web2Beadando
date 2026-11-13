<x-layout title="Új film">
    <h1 class="mb-4">Új film</h1>
    <div class="row"><div class="col-lg-7">
        <form method="POST" action="{{ route('filmek.store') }}" novalidate>
            @include('filmek._form')
        </form>
    </div></div>
</x-layout>
