<?php
// STEP 1: Database Connection
// File ini digunakan untuk menghubungkan PHP ke database MySQL.

$host = 'localhost';
$dbname = 'mini_store_php';
$username = 'root';
$password = '';

$pdo = null;

try {
    // TODO:
    // Buat koneksi database menggunakan PDO.
    // Hint:
    // $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $error) {
    die('Database connection failed: ' . $error->getMessage());
}
