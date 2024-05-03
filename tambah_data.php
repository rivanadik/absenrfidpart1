<?php 
    include "koneksi.php"; 
    
    // Tombol simpan diklik
    if(isset($_POST['btnSimpan']))
    {
        $nokartu = $_POST['nokartu'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];

        // Periksa apakah semua field telah diisi sebelum melakukan penambahan data
        if(!empty($nokartu) && !empty($nama) && !empty($alamat)) {
            // Lakukan penambahan data
            $simpan = mysqli_query($conn, "INSERT INTO siswa (nokartu, nama, alamat) VALUES ('$nokartu', '$nama', '$alamat')");
            if($simpan) {
                echo "<script>alert('Data berhasil disimpan'); window.location.replace('datasiswa.php');</script>";
            } else {
                echo "<script>alert('Gagal menyimpan data');window.location.replace('datasiswa.php');</script>";
            }
        } else {
            echo "<script>alert('Mohon lengkapi semua field'); window.location.replace('datasiswa.php');</script>";
        }
    }

    // kosongkan tabel tmprfid
    mysqli_query($conn, "DELETE FROM tmprfid");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "header.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa</title>
    <style>
    .form-group {
        margin-bottom: 20px;
    }

    .btn-submit {
        margin-top: 20px;
    }
    </style>

    <script>
    function loadNokartu() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "nokartu.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("norfid").innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }

    // Panggil fungsi loadNokartu setiap 1 detik
    setInterval(function() {
        loadNokartu();
    }, 1000);
    </script>


</head>

<body>
    <?php include "menu.php"; ?>

    <!-- Isi -->
    <div class=" container-fluid">
        <h3>Tambah Data Siswa</h3>

        <!-- Form Input -->
        <form action="" method="post">
            <div id="norfid"></div>

            <div class=" form-group">
                <label for="nama">Nama</label>
                <textarea name="nama" id="nama" placeholder="Nama" class="form-control"
                    style="width: 200px;"></textarea>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" placeholder="Alamat" class="form-control"
                    style="width: 200px;"></textarea>
            </div>

            <!-- Tombol Simpan -->
            <button type="submit" name="btnSimpan" class="btn btn-primary"
                onclick="return confirm('Apakah Anda yakin ingin menyimpan data?')">Simpan</button>
        </form>
    </div>

    <?php include "footer.php"; ?>
</body>

</html>