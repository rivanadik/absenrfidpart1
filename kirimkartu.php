<?php
include "koneksi.php";

// Baca koneksi kartu
$nokartu = $_GET['nokartu'];

// Kosongkan tabel tmprfid
mysqli_query($konek, "DELETE FROM tmprfid");

// Simpan nomor kartu yang baru ke tabel
$simpan = mysqli_query($konek, "INSERT INTO tmprfid (nokartu) VALUES ('$nokartu')");

if ($simpan) {
    echo "Berhasil";
} else {
    echo "Gagal";
}
?>