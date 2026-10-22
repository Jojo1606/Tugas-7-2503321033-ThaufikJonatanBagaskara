<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Jaket Store')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: #f5f7fb; color: #2b3445; }
        .navbar { background: #fff; box-shadow: 0 1px 8px rgba(20, 30, 60, .06); }
        .card-table { border: 0; border-radius: .75rem; box-shadow: 0 1px 8px rgba(20, 30, 60, .06); }
        .table thead th { background: #f1f4f9; font-size: .8rem; color: #4a5568; border-bottom: 0; white-space: nowrap; }
        .table td { vertical-align: middle; }

        /* Gambar produk besar, ukuran seragam */
        .product-img { width: 110px; height: 110px; object-fit: cover; border-radius: .6rem; background: #e9edf3; }
        .product-img-empty { width: 110px; height: 110px; border-radius: .6rem; background: #e9edf3; color: #9aa5b5; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; }
        .desc-cell { max-width: 320px; color: #6b7686; }
    </style>
</head>
<body>
<nav class="navbar sticky-top py-2">
    <div class="container-xxl gap-2">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('products.index') }}">
            <i class="bi bi-handbag me-1"></i>Jaket Store
        </a>
        <form class="d-flex flex-grow-1 mx-lg-4" style="max-width: 420px;" action="{{ route('products.index') }}" method="GET" role="search">
            <div class="input-group">
                <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
                <input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari jaket..." aria-label="Cari produk">
            </div>
        </form>
        <a href="{{ route('products.create') }}" class="btn btn-primary ms-auto">
            <i class="bi bi-plus-lg me-1"></i><span class="d-none d-sm-inline">Tambah Produk</span>
        </a>
    </div>
</nav>

<main class="container-xxl py-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>