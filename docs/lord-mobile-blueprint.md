# Blueprint Marketplace Lord Mobile

## Visi Produk
MarketplaceLM difokuskan untuk jual beli akun Lord Mobile dengan data akun terstandar, verifikasi listing, dan alur checkout yang aman.

## Modul Wajib

1. Modul katalog akun Lord Mobile
- Search kata kunci akun
- Filter Castle Level, Might minimum, dan Role akun
- Filter status migrasi dan bind status (fase berikutnya)

2. Modul detail listing akun
- Menampilkan statistik akun utama
- Menampilkan media bukti screenshot/video
- Tombol chat WhatsApp langsung ke admin/seller
- Tombol beli langsung ke checkout Midtrans

3. Modul checkout transaksi
- Buat order dengan status pending
- Redirect ke Midtrans Snap
- Simpan token dan redirect URL Midtrans
- Siapkan endpoint callback untuk update status otomatis (fase berikutnya)

4. Modul dashboard admin
- CRUD listing akun
- Input atribut akun Lord Mobile
- Upload gambar/video
- Aktif/nonaktif listing

5. Modul keamanan dan operasional
- Audit status order
- Validasi data listing minimum
- Terms dan disclaimer risiko akun game

## Data Listing Lord Mobile (Minimum)

1. Nama akun/listing
2. Castle Level
3. Might
4. Troop T4
5. Troop T5
6. Kingdom
7. Role akun (Rally Lead / Trap / Farmer / Mixed)
8. Bind status akun
9. Migration ticket ready
10. Hero grade summary
11. Familiar grade summary
12. Research summary
13. Harga, stok, deskripsi, media, nomor WhatsApp

## Status Order yang Direkomendasikan

1. pending_payment
2. paid
3. handover_in_progress
4. waiting_buyer_confirmation
5. completed
6. disputed
7. refunded
7. cancelled

## Roadmap Implementasi

1. Tahap 1 (sudah):
- Struktur produk dan katalog dasar
- Login/register
- Checkout Midtrans basic
- Dashboard admin basic

2. Tahap 2 (sedang dikerjakan):
- Kolom atribut Lord Mobile
- Filter Lord Mobile
- Form admin Lord Mobile

3. Tahap 3:
- Callback Midtrans + sinkronisasi status order
- Riwayat order user/admin
- Dispute center

4. Tahap 4:
- Verifikasi listing dengan checklist bukti
- Sistem rating seller dan anti-fraud scoring
