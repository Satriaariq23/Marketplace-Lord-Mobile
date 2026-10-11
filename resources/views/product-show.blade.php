@extends('layouts.app')

@section('content')
<section class="product-detail">
    <div class="media-column">
        @if ($product->video_path)
            <video controls class="detail-media">
                <source src="{{ asset('storage/'.$product->video_path) }}">
                Browser Anda tidak mendukung pemutaran video.
            </video>
        @elseif ($product->image_path)
            <img src="{{ asset('storage/'.$product->image_path) }}" alt="{{ $product->title }}" class="detail-media">
        @else
            <div class="detail-media placeholder">Preview belum tersedia</div>
        @endif
    </div>

    <div class="detail-content">
        <p class="category">Lord Mobile</p>
        <h1>{{ $product->title }}</h1>
        <p>{{ $product->description }}</p>
        <div class="detail-meta">
            <div>
                <span>Harga</span>
                <strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong>
            </div>
            <div>
                <span>Stok Tersedia</span>
                <strong>{{ $product->stock }}</strong>
            </div>
            <div>
                <span>Castle Level</span>
                <strong>{{ $product->castle_level ?: '-' }}</strong>
            </div>
            <div>
                <span>Might</span>
                <strong>{{ $product->might ? number_format($product->might, 0, ',', '.') : '-' }}</strong>
            </div>
            <div>
                <span>Troop T4 / T5</span>
                <strong>{{ $product->troop_t4 ?: 0 }} / {{ $product->troop_t5 ?: 0 }}</strong>
            </div>
            <div>
                <span>Kingdom</span>
                <strong>{{ $product->kingdom ?: '-' }}</strong>
            </div>
            <div>
                <span>Role Akun</span>
                <strong>{{ $product->account_role ?: '-' }}</strong>
            </div>
            <div>
                <span>Bind Status</span>
                <strong>{{ $product->bind_status ?: '-' }}</strong>
            </div>
            <div>
                <span>Migration Ticket</span>
                <strong>{{ $product->migration_ticket_ready ? 'Ready' : 'Belum Ready' }}</strong>
            </div>
            <div>
                <span>Hero / Familiar</span>
                <strong>{{ $product->hero_grade ?: '-' }} / {{ $product->familiar_grade ?: '-' }}</strong>
            </div>
            <div>
                <span>Research Summary</span>
                <strong>{{ $product->research_summary ?: '-' }}</strong>
            </div>
        </div>

        <div class="cta-wrap">
            @auth
                <form action="{{ route('checkout.buy', $product) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg">Beli Sekarang (Midtrans)</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Login untuk Membeli</a>
            @endauth

            @if ($whatsappLink)
                <a href="{{ $whatsappLink }}" target="_blank" rel="noopener" class="btn btn-whatsapp">Tanya via WhatsApp</a>
            @endif
        </div>
    </div>
</section>
@endsection
