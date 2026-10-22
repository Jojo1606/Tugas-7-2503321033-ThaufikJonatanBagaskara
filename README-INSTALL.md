# CRUD Produk – Laravel 13 + Bootstrap 5 + MySQL

Paket ini berisi file-file aplikasi saja (overlay). Salin ke project Laravel 13 baru.

## Langkah

1. Buat project baru (PHP >= 8.3, Composer):

       composer create-project laravel/laravel product-crud
       cd product-crud

2. Ekstrak zip ini ke dalam folder `product-crud`, timpa file jika diminta
   (`routes/web.php` akan tertimpa).

3. Atur database di `.env`:

       DB_CONNECTION=mysql
       DB_HOST=127.0.0.1
       DB_PORT=3306
       DB_DATABASE=product_crud
       DB_USERNAME=root
       DB_PASSWORD=

   Lalu buat database kosong `product_crud` di MySQL.

4. Jalankan:

       php artisan migrate
       php artisan storage:link
       php artisan serve

5. Buka http://127.0.0.1:8000

Catatan:
- Bootstrap 5 & Bootstrap Icons dimuat lewat CDN (tidak perlu npm build).
- Gambar disimpan di `storage/app/public/products` (disk `public`).
- Pastikan `APP_URL` di `.env` sesuai alamat yang dipakai agar URL gambar benar
  (mis. `http://127.0.0.1:8000`).
