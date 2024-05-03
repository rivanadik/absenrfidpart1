<?php
// Include koneksi
include "koneksi.php";

// Periksa apakah parameter ID disertakan dalam URL
if(isset($_GET['id'])) {
    // Baca ID dari URL
    $id = $_GET['id'];

    // Query untuk mengambil data siswa berdasarkan ID
    $query = mysqli_query($conn, "SELECT * FROM siswa WHERE id='$id'");
    $data = mysqli_fetch_assoc($query);

    if($data) {
        // Tampilkan pop-up konfirmasi dengan JavaScript
        echo "<script>
                var yakin = confirm('Apakah Anda yakin data dengan ID ".$data['id']." dan Nama ".$data['nama']." akan dihapus?');
                if(yakin) {
                    window.location.href = 'proses_hapus.php?id=".$id."'; // Redirect ke proses hapus jika dikonfirmasi
                } else {
                    window.history.back(); // Kembali ke halaman sebelumnya jika dibatalkan
                }
              </script>";
    } else {
        // Jika data tidak ditemukan, tampilkan pesan error
        echo "Data siswa tidak ditemukan.";
    }
} else {
    // Jika parameter ID tidak disertakan dalam URL, tampilkan pesan error
    echo "ID siswa tidak ditemukan.";
}
?>