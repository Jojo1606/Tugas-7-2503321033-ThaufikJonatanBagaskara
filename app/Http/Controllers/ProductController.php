<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    private const PER_PAGE_OPTIONS = [5, 10, 25, 50];

    public function index(Request $request): View
    {
        $perPage = (int) $request->query('per_page', 10);
        if (! in_array($perPage, self::PER_PAGE_OPTIONS, true)) {
            $perPage = 10;
        }

        $products = Product::search($request->query('q'))
            ->latest()
            ->paginate($perPage)
            ->withQueryString();

        return view('products.index', [
            'products'   => $products,
            'perPage'    => $perPage,
            'perPageOptions' => self::PER_PAGE_OPTIONS,
            'search'     => $request->query('q', ''),
        ]);
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request, imageRequired: true);

        $data['image'] = $request->file('image')->store('products', 'public');

        Product::create($data);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product): View
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $this->validated($request, imageRequired: false);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        } else {
            unset($data['image']);
        }

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    private function validated(Request $request, bool $imageRequired): array
    {
        return $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'price'       => ['required', 'integer', 'min:0', 'max:999999999999'],
            'description' => ['nullable', 'string', 'max:1000'],
            'image'       => [
                $imageRequired ? 'required' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ], [
            'name.required'  => 'Nama produk wajib diisi.',
            'price.required' => 'Harga wajib diisi.',
            'price.integer'  => 'Harga harus berupa angka bulat (tanpa titik/koma).',
            'image.required' => 'Gambar produk wajib diunggah.',
            'image.image'    => 'File harus berupa gambar.',
            'image.mimes'    => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'image.max'      => 'Ukuran gambar maksimal 2 MB.',
        ]);
    }
}
