<?php
// Konfigurasi koneksi ke database
$servername = "localhost"; // Nama server database
$username = "root"; // Username database
$password = ""; // Password database
$dbname = "absenrfid"; // Nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}


?>