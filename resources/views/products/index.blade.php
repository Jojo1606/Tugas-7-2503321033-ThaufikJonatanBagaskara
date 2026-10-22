@extends('layouts.app')

@section('title', 'Product List')

@section('content')
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1">Product List</h3>
            <p class="text-muted mb-0">Kelola koleksi jaket dan pakaian di tokomu: tambah, ubah, cari, dan hapus produk dengan mudah.</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Add Product
        </a>
    </div>

    <div class="card card-table">
        <div class="card-body">
            <form method="GET" action="{{ route('products.index') }}" class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                <div class="d-flex align-items-center gap-2">
                    <label for="per_page" class="text-muted small mb-0">Show</label>
                    <select name="per_page" id="per_page" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                        @foreach ($perPageOptions as $opt)
                            <option value="{{ $opt }}" @selected($perPage === $opt)>{{ $opt }}</option>
                        @endforeach
                    </select>
                    <span class="text-muted small">entries</span>
                </div>
                <div class="input-group input-group-sm" style="max-width: 260px;">
                    <input type="search" name="q" value="{{ $search }}" class="form-control" placeholder="Search nama / deskripsi">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width: 140px;">Gambar</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th class="text-center" style="width: 130px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>
                                    @if ($product->image_url)
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="product-img">
                                    @else
                                        <div class="product-img-empty"><i class="bi bi-image"></i></div>
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $product->name }}</td>
                                <td>{{ $product->formatted_price }}</td>
                                <td class="desc-cell">{{ \Illuminate\Support\Str::limit($product->description, 80) }}</td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-1">
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-success" title="Edit">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus produk &quot;{{ addslashes($product->name) }}&quot;?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                    Belum ada produk{{ $search ? ' yang cocok dengan pencarian' : '' }}.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mt-3">
                <div class="text-muted small">
                    Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} entries
                </div>
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
