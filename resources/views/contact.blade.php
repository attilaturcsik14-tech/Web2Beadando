<x-layout title="Kapcsolat">
    <h1 class="mb-4">Kapcsolat</h1>
    <div class="row">
        <div class="col-lg-7">
            <form method="POST" action="{{ route('contact.store') }}" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Név</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Tárgy</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}" class="form-control @error('subject') is-invalid @enderror">
                    @error('subject') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Üzenet</label>
                    <textarea id="message" name="message" rows="5" class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                    @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Küldés</button>
            </form>
        </div>
    </div>
</x-layout>
