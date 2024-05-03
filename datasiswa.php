<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "header.php"; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
</head>

<body>
    <?php include "menu.php"; ?>

    <!-- ISI -->
    <div class="container-fluid">
        <h3>Data Siswa</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">No Kartu</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>

                <!-- Koneksi ke database -->
                <?php
                    include "koneksi.php";

                    // baca data
                    $sql = mysqli_query($conn, "select * from siswa");
                    $no= 0;
                    while($data = mysqli_fetch_array($sql)) 
                    {
                        $no++; 
                ?>

                <tr>
                    <td> <?php echo $no; ?> </td>
                    <td><?php echo $data['nokartu']; ?></td> <!-- Tampilkan nomor kartu -->
                    <td><?php echo $data['nama']; ?></td> <!-- Tampilkan nama -->
                    <td><?php echo $data['alamat']; ?></td> <!-- Tampilkan alamat -->
                    <td>
                        <a href="edit.php?id=<?php echo $data['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="hapus.php?id=<?php echo $data['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>

            </tbody>
        </table>
        <!-- Tombol tambah data -->
        <a href="tambah_data.php" class="btn btn-primary">Tambah Data</a>
    </div>

    <?php include "footer.php"; ?>
</body>

</html>