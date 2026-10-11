# MarketplaceLM

Website jual beli akun Lord Mobile berbasis Laravel 12 dengan fitur:

- Login dan daftar pengguna
- Katalog akun Lord Mobile
- Search akun berdasarkan keyword, Castle Level, Might, dan Role
- Detail produk dengan tombol chat WhatsApp
- Checkout yang mengarah ke pembayaran pihak ketiga Midtrans (contoh integrasi Snap)
- Dashboard admin untuk tambah/edit/hapus produk
- Upload media produk (gambar dan video)
- Database MySQL lengkap via migration atau SQL import

## Stack

- Laravel 12
- MySQL
- Vite
- Bootstrap (asset) + custom CSS

## Setup Cepat

1. Install dependency:
	- `composer install`
	- `npm install`

2. Siapkan environment:
	- Copy `.env.example` ke `.env`
	- Jalankan `php artisan key:generate`
	- Pastikan konfigurasi DB MySQL di `.env`:
	  - `DB_DATABASE=marketplacelm`
	  - `DB_USERNAME=root`
	  - `DB_PASSWORD=`

3. Opsi setup database:
	- Opsi A (disarankan):
	  - `php artisan migrate --seed`
	- Opsi B (manual SQL):
	  - Import file `database/marketplacelm.sql` ke MySQL

4. Storage link untuk file upload:
	- `php artisan storage:link`

5. Build asset frontend:
	- `npm run dev` (development)
	- atau `npm run build` (production)

6. Jalankan aplikasi:
	- `php artisan serve`

## Akun Demo

- Admin
  - Email: `admin@marketplacelm.test`
  - Password: `password123`
- Buyer
  - Email: `buyer@marketplacelm.test`
  - Password: `password123`

## Konfigurasi Midtrans

Isi variabel ini di `.env`:

- `MIDTRANS_SERVER_KEY=`
- `MIDTRANS_CLIENT_KEY=`
- `MIDTRANS_IS_PRODUCTION=false`

Jika server key tidak diisi, tombol beli tetap akan mengarah ke halaman produk Midtrans sebagai contoh pihak ketiga.

## Konfigurasi WhatsApp

Isi nomor admin default di `.env`:

- `WHATSAPP_ADMIN_NUMBER=6281234567890`

Nomor ini dipakai sebagai fallback jika produk tidak punya nomor WhatsApp sendiri.

## Fitur Admin Produk

Admin bisa:

- Menambahkan produk
- Mengisi data statistik akun Lord Mobile (Castle, Might, T4/T5, Kingdom, Role, Bind, Research)
- Mengubah deskripsi, harga, stok, status aktif
- Upload gambar produk
- Upload video produk
- Hapus produk

Akses dashboard admin di:

- `/admin/dashboard`

## Catatan

- Untuk upload video besar, pastikan `upload_max_filesize` dan `post_max_size` di `php.ini` memadai.
- Untuk produksi, gunakan kredensial Midtrans production dan set `MIDTRANS_IS_PRODUCTION=true`.
