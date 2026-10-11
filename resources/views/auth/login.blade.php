@extends('layouts.app')

@section('content')
<section class="auth-wrap">
    <form action="{{ route('login.store') }}" method="POST" class="auth-card">
        @csrf
        <h1>Login Akun</h1>
        <p>Masuk untuk melanjutkan pembelian akun digital.</p>

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label class="remember">
            <input type="checkbox" name="remember" value="1">
            Ingat saya
        </label>

        <button type="submit" class="btn btn-primary">Login</button>
        <p class="auth-switch">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
    </form>
</section>
@endsection
