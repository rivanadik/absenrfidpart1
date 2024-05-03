<?php 
    include "koneksi.php"; 

    // Baca ID data yang akan diedit
    $id = $_GET['id'];

    // Baca data siswa berdasarkan id
    $cari = mysqli_query($conn, "SELECT * FROM siswa WHERE id='$id'");
    $hasil = mysqli_fetch_array($cari);
    
    // Tombol simpan diklik
    if(isset($_POST['btnSimpan']))
    {
        $nokartu = $_POST['nokartu'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];

        // Periksa apakah semua field telah diisi sebelum melakukan pembaruan data
        if(!empty($nokartu) && !empty($nama) && !empty($alamat)) {
            // Lakukan pembaruan data
            $update = mysqli_query($conn, "UPDATE siswa SET nokartu='$nokartu', nama='$nama', alamat='$alamat' WHERE id='$id'");
            if($update) {
                echo "<script>alert('Data berhasil diperbarui'); window.location.replace('datasiswa.php');</script>";
            } else {
                echo "<script>alert('Gagal memperbarui data');window.location.replace('datasiswa.php');</script>";
            }
        } else {
            echo "<script>alert('Mohon lengkapi semua field');</script>";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "header.php"; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
    <style>
    .form-group {
        margin-bottom: 20px;
    }

    .btn-submit {
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <?php include "menu.php"; ?>

    <!-- Isi -->
    <div class="container-fluid">
        <h3>Edit Data Siswa</h3>

        <!-- Form Input -->
        <form action="" method="post">
            <div class="form-group">
                <label for="nokartu">No Kartu</label>
                <input type="text" name="nokartu" id="nokartu" placeholder="No Kartu RFID" class="form-control"
                    style="width: 200px;" value="<?php echo $hasil['nokartu']; ?>">
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <textarea name="nama" id="nama" placeholder="Nama" class="form-control"
                    style="width: 200px;"><?php echo $hasil['nama']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" placeholder="Alamat" class="form-control"
                    style="width: 200px;"><?php echo $hasil['alamat']; ?></textarea>
            </div>

            <!-- Tombol Simpan -->
            <button type="submit" name="btnSimpan" class="btn btn-primary"
                onclick="return confirm('Apakah Anda yakin ingin menyimpan perubahan?')">Simpan</button>
        </form>
    </div>

    <?php include "footer.php"; ?>
</body>

</html>