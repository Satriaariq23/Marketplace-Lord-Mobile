@extends('layouts.app')

@section('content')
<section class="admin-head">
    <h1>Dashboard Admin Produk</h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Tambah Produk</a>
</section>

<section class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->category }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-ghost">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination-wrap">
        {{ $products->links() }}
    </div>
</section>
@endsection
