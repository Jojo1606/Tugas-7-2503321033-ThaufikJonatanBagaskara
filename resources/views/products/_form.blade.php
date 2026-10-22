@php($editing = isset($product))

<div class="mb-3">
    <label for="name" class="form-label">Nama Produk</label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $product->name ?? '') }}" required>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label for="price" class="form-label">Harga Jual</label>
    <div class="input-group @error('price') has-validation @enderror">
        <span class="input-group-text">Rp</span>
        <input type="number" name="price" id="price" min="0" step="1"
               class="form-control @error('price') is-invalid @enderror"
               value="{{ old('price', $product->price ?? '') }}" required>
        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Deskripsi</label>
    <textarea name="description" id="description" rows="4"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-4">
    <label for="image" class="form-label">Gambar Produk</label>
    <div class="d-flex align-items-center gap-3 mb-2">
        <img id="image-preview"
             src="{{ $editing && $product->image_url ? $product->image_url : '' }}"
             alt="Preview"
             class="product-img {{ $editing && $product->image_url ? '' : 'd-none' }}"
             style="width: 96px; height: 96px;">
    </div>
    <input type="file" name="image" id="image" accept=".jpg,.jpeg,.png,.webp"
           class="form-control @error('image') is-invalid @enderror" {{ $editing ? '' : 'required' }}>
    <div class="form-text">
        Format JPG, PNG, atau WEBP. Maksimal 2 MB.{{ $editing ? ' Kosongkan jika tidak ingin mengganti gambar.' : '' }}
    </div>
    @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
</div>

@push('scripts')
<script>
    document.getElementById('image').addEventListener('change', function (e) {
        const file = e.target.files[0];
        const preview = document.getElementById('image-preview');
        if (!file) return;
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('d-none');
    });
</script>
@endpush
