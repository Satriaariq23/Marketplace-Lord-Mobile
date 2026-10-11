@extends('layouts.app')

@section('content')
<section class="auth-wrap">
    <form action="{{ route('register.store') }}" method="POST" class="auth-card">
        @csrf
        <h1>Daftar Akun Baru</h1>
        <p>Buat akun untuk mulai transaksi jual beli akun digital.</p>

        <label>Nama Lengkap</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>No. WhatsApp</label>
        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="62812xxxx">

        <label>Password</label>
        <input type="password" name="password" required>

        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit" class="btn btn-primary">Daftar</button>
        <p class="auth-switch">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
    </form>
</section>
@endsection
