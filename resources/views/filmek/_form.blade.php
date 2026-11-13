@csrf
<div class="mb-3">
    <label for="filmcim" class="form-label">Cím</label>
    <input type="text" id="filmcim" name="filmcim" value="{{ old('filmcim', $film->filmcim ?? '') }}" class="form-control @error('filmcim') is-invalid @enderror">
    @error('filmcim') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="mufaj" class="form-label">Műfaj</label>
        <input type="text" id="mufaj" name="mufaj" value="{{ old('mufaj', $film->mufaj ?? '') }}" class="form-control @error('mufaj') is-invalid @enderror">
        @error('mufaj') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="szarmazas" class="form-label">Származás</label>
        <input type="text" id="szarmazas" name="szarmazas" value="{{ old('szarmazas', $film->szarmazas ?? '') }}" class="form-control @error('szarmazas') is-invalid @enderror">
        @error('szarmazas') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="hossz" class="form-label">Hossz (perc)</label>
        <input type="number" id="hossz" name="hossz" value="{{ old('hossz', $film->hossz ?? '') }}" class="form-control @error('hossz') is-invalid @enderror">
        @error('hossz') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="szinkron" class="form-label">Nyelv</label>
        @php($sz = old('szinkron', $film->szinkron ?? ''))
        <select id="szinkron" name="szinkron" class="form-select @error('szinkron') is-invalid @enderror">
            <option value="" @selected($sz === '')>-</option>
            <option value="fel" @selected($sz === 'fel')>feliratos</option>
            <option value="mb" @selected($sz === 'mb')>magyarul beszélő</option>
        </select>
        @error('szinkron') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>
<div class="form-check mb-3">
    <input type="checkbox" id="szines" name="szines" value="1" class="form-check-input" @checked(old('szines', $film->szines ?? true))>
    <label for="szines" class="form-check-label">Színes film</label>
</div>
<button type="submit" class="btn btn-primary">Mentés</button>
<a href="{{ route('filmek.index') }}" class="btn btn-outline-secondary">Mégsem</a>
