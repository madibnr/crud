<?php
// Konfigurasi database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'arkatama_store';

// Membuat koenksi ke database
$conn = mysqli_connect($host, $user, $password, $database);

//Cek koneksi
if (!$conn) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}
?>