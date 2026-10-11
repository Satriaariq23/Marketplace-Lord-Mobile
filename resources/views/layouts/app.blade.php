<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'MarketplaceLM - Jual Beli Akun Lord Mobile' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="background-blobs" aria-hidden="true">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <header class="topbar">
        <a href="{{ route('home') }}" class="brand">MarketplaceLM</a>
        <nav class="menu">
            <a href="{{ route('home') }}">Beranda</a>
            @auth
                @if (auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-ghost">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
            @endauth
        </nav>
    </header>

    <main class="container">
        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer">
        <p>MarketplaceLM Lord Mobile · Aman, cepat, dan siap integrasi pembayaran Midtrans</p>
    </footer>
</body>
</html>
