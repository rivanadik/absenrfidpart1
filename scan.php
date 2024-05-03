<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "header.php"; ?>
    <title>Scan Kartu</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Scan kartu RFID -->
    <script type="text/javascript">
    $(document).ready(function() {
        setInterval(function() {
            $("#cekkartu").load('bacakartu.php')
        }, 2000);
    });
    </script>
</head>

<body>
    <?php include "menu.php"; ?>

    <!-- Isi -->
    <div class="container-fluid" style="padding-top: 10%">
        <div id="cekkartu"></div>
    </div>
    <br>

    <?php include "footer.php"; ?>
</body>

</html>