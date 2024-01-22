<?php
// $my_app_name = "SYSTEM RESERVE V.0.0.1";
require_once ("service/database.php"); //untuk menghasilkan output db (test aja)
session_start();

if ($_SESSION['is_login'] == false) {
    header("location: login.php");
}

define("APP_NAME", "SYSTEM RESERVE - v.0.0.1");

$select_meja_query = "SELECT * FROM meja";
$count_meja_query = "SELECT COUNT(status) as total_count, SUM(status=1) as total_row FROM meja";

$select_meja = $db->query($select_meja_query); //--- dari database
$count_meja = $db->query($count_meja_query);

$status = $count_meja->fetch_assoc();
$jumlah_meja = $status["total_count"];
$meja_isi = $status["total_row"];

$is_full = false;

if ($jumlah_meja == $meja_isi) {
    $is_full = true;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title><?= APP_NAME ?></title>
</head>
<body>
    <?php include("layout/header.php") ?>
    <br/>
    <?php
    $sisa_meja = $jumlah_meja - $meja_isi;

    if ($is_full) {
        echo "<h1 align='center'>MEJA PENUH</h1>";
    } else {
        echo "<h1 align='center'>Terdapat $sisa_meja meja kosong</h1>";
    }
    ?>
    <div class="container">
        <?php
    foreach ($select_meja as $meja ) { // mapping data dari database
        ?>
        <div class="card" onclick="goToMeja(`<?= $meja['no_meja'] ?>`, `<?= $meja['nama_pelanggan'] ?>`)">
        <h2><?= $meja['tipe_meja'] . " " . $meja['no_meja'] ?></h2>
        <br/>
        <p>
            <!-- <?php if ($meja['nama_pelanggan'] == NULL AND $meja['jumlah_orang'] == NULL){
                echo "Meja kosong";
            }
                ?> -->
            <?= $meja['nama_pelanggan'] == NULL && $meja['jumlah_orang'] == NULL ? "Meja kosong" : $meja['nama_pelanggan'] . " " . $meja['jumlah_orang'] . " orang" ?>
        </p>
        </div>
        <?php } ?> 
    </div>
    <script>
        function goToMeja(no_meja, nama_pelanggan) {
            const url = "meja.php";
            const params = `?no_meja=${no_meja}&nama_pelanggan=${nama_pelanggan}`
            window.location.replace(url + params);
        }
    </script>
</body>
</html>