<?php
// Konfigurasi database
$host = "localhost"; // Nama host (default: localhost)
$user = "root"; // Username MySQL (default: root)
$pass = ""; // Password MySQL (kosongkan jika default)
$dbname = "minilibrary"; // Nama database Anda

// Membuat koneksi
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
} else {
    //echo "Koneksi berhasil!";
}
?>
