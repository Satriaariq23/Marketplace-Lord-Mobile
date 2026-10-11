@extends('layouts.app')

@section('content')
<section class="auth-wrap">
    <form action="{{ $isEdit ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="auth-card wide">
        @csrf
        @if ($isEdit)
            @method('PUT')
        @endif

        <h1>{{ $isEdit ? 'Edit Produk' : 'Tambah Produk Baru' }}</h1>

        <label>Nama Produk</label>
        <input type="text" name="title" value="{{ old('title', $product->title) }}" required>

        <label>Kategori</label>
        <input type="text" value="Lord Mobile" disabled>

        <label>Castle Level (1-25)</label>
        <input type="number" name="castle_level" min="1" max="25" value="{{ old('castle_level', $product->castle_level) }}">

        <label>Might</label>
        <input type="number" name="might" min="0" value="{{ old('might', $product->might) }}" placeholder="Contoh: 980000000">

        <label>Troop T4</label>
        <input type="number" name="troop_t4" min="0" value="{{ old('troop_t4', $product->troop_t4) }}">

        <label>Troop T5</label>
        <input type="number" name="troop_t5" min="0" value="{{ old('troop_t5', $product->troop_t5) }}">

        <label>Kingdom</label>
        <input type="text" name="kingdom" value="{{ old('kingdom', $product->kingdom) }}" placeholder="Contoh: K1234">

        <label>Role Akun</label>
        <input type="text" name="account_role" value="{{ old('account_role', $product->account_role) }}" placeholder="Rally Lead / Trap / Farmer / Mixed">

        <label>Bind Status</label>
        <input type="text" name="bind_status" value="{{ old('bind_status', $product->bind_status) }}" placeholder="Unbind Ready / Google Bound / FB Bound">

        <label>Hero Grade Summary</label>
        <input type="text" name="hero_grade" value="{{ old('hero_grade', $product->hero_grade) }}" placeholder="Contoh: 6 Gold, 12 Purple">

        <label>Familiar Grade Summary</label>
        <input type="text" name="familiar_grade" value="{{ old('familiar_grade', $product->familiar_grade) }}" placeholder="Contoh: 4 Elder, 8 Adult">

        <label>Research Summary</label>
        <textarea name="research_summary" rows="3" placeholder="Contoh: Military 95%, Economy 80%">{{ old('research_summary', $product->research_summary) }}</textarea>

        <label>Deskripsi</label>
        <textarea name="description" rows="5" required>{{ old('description', $product->description) }}</textarea>

        <label>Harga</label>
        <input type="number" name="price" min="1000" value="{{ old('price', $product->price) }}" required>

        <label>Stok</label>
        <input type="number" name="stock" min="0" value="{{ old('stock', $product->stock ?? 0) }}" required>

        <label>No. WhatsApp Produk (Opsional)</label>
        <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $product->whatsapp_number) }}" placeholder="62812xxxx">

        <label>Upload Gambar (jpg/png/webp)</label>
        <input type="file" name="image" accept="image/*">

        <label>Upload Video (mp4/webm/mov)</label>
        <input type="file" name="video" accept="video/mp4,video/webm,video/quicktime">

        <label class="remember">
            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true))>
            Produk aktif ditampilkan di website
        </label>

        <label class="remember">
            <input type="checkbox" name="migration_ticket_ready" value="1" @checked(old('migration_ticket_ready', $product->migration_ticket_ready ?? false))>
            Migration ticket ready
        </label>

        <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Simpan Perubahan' : 'Tambah Produk' }}</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">Kembali ke Dashboard</a>
    </form>
</section>
@endsection
