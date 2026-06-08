# Mini Store PHP Starter — Student Version

Project ini adalah bahan praktik untuk sesi **CRUD & Data Flow Practice**.

Fokus praktik:

1. Create, read, update, delete concept
2. Data lifecycle
3. Transaction flow
4. Reduce stock automatically
5. Validate insufficient stock
6. Logical thinking practice

## Output Praktik

Di akhir praktik, teman-teman akan punya aplikasi mini store sederhana dengan fitur:

- Menampilkan data produk dari database
- Menambahkan produk baru
- Mengedit produk
- Menghapus produk
- Membuat transaksi penjualan
- Mengecek stok sebelum transaksi
- Mengurangi stok otomatis setelah transaksi berhasil
- Menampilkan riwayat transaksi

## Cara Menjalankan

1. Buka phpMyAdmin.
2. Import file `database.sql`.
3. Pastikan database bernama `mini_store_php` sudah muncul.
4. Buka file `config/database.php`.
5. Lengkapi kode koneksi database pada bagian `TODO`.
6. Jalankan project menggunakan Laragon/XAMPP.
7. Buka project di browser.

## Alur Praktik di Kelas

### Step 1 — Database Connection

File:

```txt
config/database.php
```

Tugas:

- Buat koneksi ke database menggunakan PDO.
- Simpan koneksi ke variable `$pdo`.

### Step 2 — Read Product & Transaction Data

File:

```txt
index.php
```

Tugas:

- Ambil data dari tabel `products`.
- Ambil data dari tabel `transactions`.
- Tampilkan data ke table UI.

### Step 3 — Create Product

File:

```txt
actions/create-product.php
```

Tugas:

- Ambil input dari form produk.
- Validasi input.
- Simpan data ke tabel `products`.

### Step 4 — Update Product

File:

```txt
edit-product.php
actions/update-product.php
```

Tugas:

- Ambil detail produk berdasarkan id.
- Tampilkan data ke form edit.
- Update data produk ke database.

### Step 5 — Delete Product

File:

```txt
actions/delete-product.php
```

Tugas:

- Ambil id produk.
- Hapus produk dari database.

### Step 6 — Create Transaction Flow

File:

```txt
actions/create-transaction.php
```

Tugas:

- Ambil produk yang dipilih.
- Ambil quantity.
- Hitung total transaksi.
- Simpan transaksi ke tabel `transactions`.

### Step 7 — Validate Insufficient Stock

File:

```txt
actions/create-transaction.php
```

Tugas:

- Cek stok produk sebelum transaksi disimpan.
- Jika stok kurang, transaksi ditolak.

### Step 8 — Reduce Stock Automatically

File:

```txt
actions/create-transaction.php
```

Tugas:

- Jika stok cukup, kurangi stok produk.
- Simpan transaksi.
- Tampilkan stok terbaru di table produk.

## Logical Thinking Flow

Sebelum coding transaksi, pikirkan alurnya:

```txt
User memilih produk
User memasukkan quantity
System mengambil data produk dari database
System mengecek stok
Jika stok kurang, transaksi ditolak
Jika stok cukup, transaksi disimpan
Stock produk dikurangi
User melihat data terbaru
```

## Catatan

File starter ini memang belum memiliki logic lengkap. Bagian yang harus dikerjakan ditandai dengan komentar `TODO`.
