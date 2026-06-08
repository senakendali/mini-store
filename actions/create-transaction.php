<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../helpers.php';

// STEP 6, 7, 8: Create Transaction Flow
// TODO:
// 1. Ambil product_id dan quantity dari $_POST.
// 2. Validasi product_id dan quantity.
// 3. Ambil data product dari database.
// 4. Cek apakah stok cukup.
// 5. Jika stok kurang, redirect dengan pesan error.
// 6. Jika stok cukup:
//    - hitung total_price
//    - simpan transaksi ke table transactions
//    - kurangi stock product di table products
// 7. Redirect dengan pesan sukses.
//
// Logical thinking:
// User memilih produk → input quantity → cek database → validasi stok → simpan transaksi → kurangi stok

redirectWithMessage('info', 'TODO: Transaction logic is not implemented yet.');
