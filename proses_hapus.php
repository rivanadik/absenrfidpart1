<?php
// Include koneksi
include "koneksi.php";

// Periksa apakah parameter ID disertakan dalam URL
if(isset($_GET['id'])) {
    // Baca ID dari URL
    $id = $_GET['id'];

    // Query untuk menghapus data siswa berdasarkan ID
    $hapus = mysqli_query($conn, "DELETE FROM siswa WHERE id='$id'");

    // Periksa apakah penghapusan berhasil
    if($hapus) {
        // Redirect kembali ke halaman datasiswa.php setelah penghapusan berhasil
        header("Location: datasiswa.php");
        exit(); // Hentikan eksekusi skrip
    } else {
        // Jika penghapusan gagal, tampilkan pesan error
        echo "Gagal menghapus data siswa.";
    }
} else {
    // Jika parameter ID tidak disertakan dalam URL, tampilkan pesan error
    echo "ID siswa tidak ditemukan.";
}
?>