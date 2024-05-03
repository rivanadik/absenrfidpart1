<?php
include "koneksi.php";

// inisialisasi variabel nokartu
$nokartu = "";

// baca tabel tmprfid
$baca_kartu = mysqli_query($conn, "SELECT * FROM tmprfid");
$data_kartu = mysqli_fetch_array($baca_kartu);

// memeriksa apakah query mengembalikan hasil
if ($data_kartu !== null) {
    $nokartu = $data_kartu['nokartu'];
}

// baca tabel status untuk mode absen
$sql_status = mysqli_query($conn, "SELECT * FROM status");
$data_status = mysqli_fetch_array($sql_status);
$mode_absen = $data_status['mode'];

// uji mode absen
$mode = "";
if ($mode_absen == 1)
    $mode = "Masuk";
else if ($mode_absen == 2)
    $mode = "Istirahat";
else if ($mode_absen == 3)
    $mode = "Kembali";
else if ($mode_absen == 4)
    $mode = "Pulang";

?>

<div class="container-fluid" style="text-align:center">

    <?php if(empty($nokartu)) { ?>
    <!-- Jika tidak ada kartu yang ditempelkan -->
    <br>
    <h2>Absen : <?php echo $mode ?></h2>
    <h3>Silahkan Tempelkan Kartu RFID</h3>
    <img src="images/rfid.png" style="width: 200px">
    <br>
    <img src="images/animasi2.gif">

    <?php } else {
        // cek no kartu rfid apakah sudah terdaftar belum di tabel siswa
        $cari_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE nokartu='$nokartu'");
        $jumlah_data = mysqli_num_rows($cari_siswa);
        
        if($jumlah_data == 0) {
            echo "<h2>Maaf tidak dikenali</h2>";
        } else {
            // ambil data siswa
            $data_siswa = mysqli_fetch_array($cari_siswa);
            $nama = $data_siswa['nama'];
            
            // tanggal dan jam hari ini
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d');
            $jam = date('H:i:s');

            // cek tabel absensi, apakah no kartu sudah ada sesuai tanggal saat ini.
            $cari_absen = mysqli_query($conn, "SELECT * FROM absensi WHERE nokartu='$nokartu' AND tanggal='$tanggal'");
            
            // hitung jumlah data absensi
            $jumlah_absen = mysqli_num_rows($cari_absen);
            if($jumlah_absen == 0){
                // jika belum ada data absensi untuk hari ini
                echo "Selamat datang, $nama!";
                // absen masuk
                mysqli_query($conn, "INSERT INTO absensi (nokartu, tanggal, jam_masuk) VALUES ('$nokartu', '$tanggal', '$jam')");
            } else {
                // jika sudah ada data absensi untuk hari ini
                if($mode_absen == 2) {
                    // absen istirahat
                    echo "Selamat istirahat, $nama!";
                    mysqli_query($conn, "UPDATE absensi SET jam_istirahat='$jam' WHERE nokartu='$nokartu' AND tanggal='$tanggal'");
                } else if ($mode_absen == 3) {
                    // absen kembali
                    echo "Selamat kembali, $nama!";
                    mysqli_query($conn, "UPDATE absensi SET jam_kembali='$jam' WHERE nokartu='$nokartu' AND tanggal='$tanggal'");
                } else if ($mode_absen == 4) {
                    // absen pulang
                    echo "Selamat pulang, $nama!";
                    mysqli_query($conn, "UPDATE absensi SET jam_pulang='$jam' WHERE nokartu='$nokartu' AND tanggal='$tanggal'");
                } else {
                    echo "Mode absen tidak valid";
                }
            }
        }

        // kosongkan tabel tmprfid
        mysqli_query($conn, "DELETE FROM tmprfid");
    } ?>
</div>