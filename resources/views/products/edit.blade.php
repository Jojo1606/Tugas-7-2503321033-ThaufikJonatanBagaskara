@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    <div class="mb-4">
        <h3 class="fw-bold mb-1">Edit Product</h3>
        <p class="text-muted mb-0">Perbarui data produk di bawah ini.</p>
    </div>

    <div class="card card-table" style="max-width: 720px;">
        <div class="card-body">
            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('products._form')
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
