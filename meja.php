<?php
require_once("service/database.php");
session_start();

if (isset($_SESSION['is_login']) == false) {
    header("location: login.php");
}

define('APP_NAME', "NOMOR MEJA");

$no_meja = "";
$nama_pelanggan = "";
$update_notif = "";

if(isset($_GET['no_meja']) && $_GET['no_meja'] !== ""){
    $no_meja = $_GET['no_meja'];
}

if(isset($_GET['nama_pelanggan']) && $_GET['nama_pelanggan'] !== "")
{
    $nama_pelanggan = $_GET['nama_pelanggan'];
    header("location: finishorder.php?no_meja=$no_meja&nama_pelanggan=$nama_pelanggan");
}

if(isset($_POST['update'])) {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $jumlah_orang = $_POST['jumlah_orang']; 
    
    $update_meja_query = "UPDATE meja SET nama_pelanggan='$nama_pelanggan', jumlah_orang='$jumlah_orang', status=1 WHERE no_meja='$no_meja'";

    $update_meja = $db->query($update_meja_query);

    if($update_meja) {
        header("location: index.php");
    }else {
       $update_notification = "gagal update data meja, silahkan coba lagi";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>Reserve meja</title>
</head>
<body>
    <?php include("layout/header.php"); ?>
    <div class="super-center">
        <h1><?= APP_NAME; echo $no_meja ?></h1>
        <i><?= $update_notif ?></i>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <label>Nama Pelanggan</label>
            <input name="nama_pelanggan" />
            <label>Jumlah Orang</label>
            <input name="jumlah_orang" />
            <button type="submit" name="update">Update Meja</button>
        </form>
    </div>
</body>
</html>