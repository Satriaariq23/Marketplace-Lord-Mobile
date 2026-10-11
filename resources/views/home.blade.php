@extends('layouts.app')

@section('content')
<section class="hero">
    <div>
        <p class="badge">Marketplace Lord Mobile</p>
        <h1>Jual Beli Akun Lord Mobile Premium</h1>
        <p class="subtitle">Fokus pada akun Lord Mobile dengan data statistik lengkap: Castle Level, Might, T4/T5, Kingdom, dan Role akun.</p>
    </div>
    <div class="hero-stats">
        <article>
            <strong>{{ $products->total() }}</strong>
            <span>Produk Aktif</span>
        </article>
        <article>
            <strong>24/7</strong>
            <span>Support Chat</span>
        </article>
        <article>
            <strong>Secure</strong>
            <span>Checkout Midtrans</span>
        </article>
    </div>
</section>

<section class="search-wrap">
    <form action="{{ route('home') }}" method="GET" class="search-form">
        <input type="text" name="q" value="{{ $search }}" placeholder="Cari akun: kingdom, role, keyword...">
        <input type="number" name="min_castle" value="{{ $minCastle ?: '' }}" min="1" max="25" placeholder="Min Castle Lv">
        <input type="number" name="min_might" value="{{ $minMight ?: '' }}" min="0" placeholder="Min Might">
        <select name="role">
            <option value="">Semua Role</option>
            @foreach ($roles as $item)
                <option value="{{ $item }}" @selected($role === $item)>{{ $item }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</section>

<section class="grid-products">
    @forelse ($products as $product)
        <article class="product-card">
            <a href="{{ route('products.show', $product) }}" class="media-box">
                @if ($product->image_path)
                    <img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->title }}">
                @elseif ($product->video_path)
                    <video src="{{ asset('storage/'.$product->video_path) }}" muted autoplay loop></video>
                @else
                    <div class="placeholder">{{ strtoupper(substr($product->category, 0, 2)) }}</div>
                @endif
            </a>
            <div class="content">
                <p class="category">Lord Mobile · {{ $product->account_role ?: 'General' }}</p>
                <h3>{{ $product->title }}</h3>
                <p class="desc">{{ \Illuminate\Support\Str::limit($product->description, 90) }}</p>
                <div class="meta">
                    <span>Castle {{ $product->castle_level ?: '-' }} · Might {{ $product->might ? number_format($product->might, 0, ',', '.') : '-' }}</span>
                    <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong>
                </div>
                <a href="{{ route('products.show', $product) }}" class="btn btn-ghost">Lihat Detail</a>
            </div>
        </article>
    @empty
        <div class="empty-state">
            <h3>Produk belum ditemukan</h3>
            <p>Coba kata kunci lain atau ganti kategori pencarian.</p>
        </div>
    @endforelse
</section>

<div class="pagination-wrap">
    {{ $products->links() }}
</div>
@endsection
