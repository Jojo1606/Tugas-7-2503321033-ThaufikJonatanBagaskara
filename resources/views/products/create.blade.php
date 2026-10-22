@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Add Product</h3>
        <p class="text-muted mb-0">Isi form berikut untuk menambahkan produk baru.</p>
    </div>

    <div class="card card-table" style="max-width: 720px;">
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @include('products._form')
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
