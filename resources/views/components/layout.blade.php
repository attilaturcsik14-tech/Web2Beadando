@props(['title' => 'Főoldal'])
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} – {{ config('app.name') }}</title>
    {{-- Ingyenes, reszponzív téma: Bootswatch "Flatly" (Bootstrap 5) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/flatly/bootstrap.min.css">
</head>
<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Főoldal</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('adatbazis') ? 'active' : '' }}" href="{{ route('adatbazis') }}">Adatbázis</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Kapcsolat</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('diagram') ? 'active' : '' }}" href="{{ route('diagram') }}">Diagram</a></li>
                @auth
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('messages') ? 'active' : '' }}" href="{{ route('messages') }}">Üzenetek</a></li>
                    @if (Auth::user()->isAdmin())
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('filmek.*') ? 'active' : '' }}" href="{{ route('filmek.index') }}">CRUD</a></li>
                    @endif
                @endauth
            </ul>
            <ul class="navbar-nav">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Bejelentkezés</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Regisztráció</a></li>
                @endguest
                @auth
                    <li class="nav-item"><span class="navbar-text me-3">{{ Auth::user()->name }}</span></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">Kijelentkezés</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="container py-4 flex-grow-1">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    {{ $slot }}
</main>

<footer class="bg-light border-top py-3 mt-auto">
    <div class="container text-center text-muted">
        {{-- TODO: írd be a készítő(k) nevét és Neptun kódját --}}
        Készítette: [NÉV] ([NEPTUN])
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
