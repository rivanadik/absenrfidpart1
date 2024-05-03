<?php
include "koneksi.php";

// Baca tabel tmprfid
$sql = mysqli_query($conn, "SELECT * FROM tmprfid");
if($sql && mysqli_num_rows($sql) > 0) {
    $data = mysqli_fetch_array($sql);

    // Baca nokartu
    $nokartu = $data['nokartu'];
} else {
    // Handle jika tidak ada data tersedia
    $nokartu = ""; // Atau berikan nilai default
}
?>

<div class="form-group">
    <label for="nokartu">No Kartu</label>
    <input type="text" name="nokartu" id="nokartu" placeholder="Tempelkan Kartu RFID" class="form-control"
        style="width: 200px;" value="<?php echo $nokartu; ?>">
</div>