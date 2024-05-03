<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "header.php"; ?>
    <title>Rekapitulasi absensi</title>
    <style>
    .table th {
        background-color: grey;
        color: white;
    }
    </style>
</head>

<body>
    <?php include "menu.php"; ?>

    <!-- Isi -->
    <div class="container-fluid">
        <h3>Rekapitulasi Absen</h3>

        <!-- Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10%; text-align: center;">No.</th>
                    <th style="width: 20%; text-align: center;">Nama</th>
                    <th style="width: 15%; text-align: center;">Tanggal</th>
                    <th style="width: 15%; text-align: center;">Jam Masuk</th>
                    <th style="width: 15%; text-align: center;">Jam Istirahat</th>
                    <th style="width: 15%; text-align: center;">Jam Kembali</th>
                    <th style="width: 15%; text-align: center;">Jam Pulang</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include "koneksi.php";

                    // baca tabel absen dan realisasikan dengan tabel siswa berdasar no kartu RFID untuk tanggal hari ini

                    // baca tanggal saat ini
                    date_default_timezone_set('Asia/Jakarta');
                    $tanggal = date('Y-m-d');

                    // filter absen berdasar tanggal hari ini
                    $sql = mysqli_query($conn, "SELECT b.nama, a.tanggal, a.jam_masuk, a.jam_istirahat, a.jam_kembali, a.jam_pulang FROM absensi a, siswa b WHERE a.nokartu=b.nokartu AND a.tanggal='$tanggal'");

                    $no = 0;
                    while($data = mysqli_fetch_array($sql)) {
                        $no++;
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['nama']; ?></td>
                    <td><?php echo $data['tanggal']; ?></td>
                    <td><?php echo $data['jam_masuk']; ?></td>
                    <td><?php echo $data['jam_istirahat']; ?></td>
                    <td><?php echo $data['jam_kembali']; ?></td>
                    <td><?php echo $data['jam_pulang']; ?></td>
                </tr>
                <?php 
                    }
                ?>
            </tbody>
        </table>
    </div>

    <?php include "footer.php"; ?>
</body>

</html>