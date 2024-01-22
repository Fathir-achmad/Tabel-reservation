<?php 
require_once("service/database.php");
session_start();
$login_notif = "";

if (isset($_SESSION['is_login']) && $_SESSION['is_login']) { //--- Validasi admin udah login atau belum
    header("location: index.php");
}

if (isset($_POST['login'])) { // isset untuk memastikan apakah username sama dengan yg di db
    $username =  $_POST["username"];
    $password =  $_POST["password"];

    $select_admin_query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'"; //-- ini untuk mencari ada data tsbt dalam db apa engga

    $select_admin = $db->query($select_admin_query);

    if ($select_admin->num_rows > 0) {
        // $login_notif = "Halo selamat datang kembali";
        $admin = $select_admin->fetch_assoc(); // untuk manggil database masing masing menggunakan fetch_assoc
        $_SESSION['is_login'] = true; //session untuk 
        $_SESSION['username'] = $admin['username'];

        header("location: index.php");
    }else{
        $login_notif = "Akun admin tidak di temukan";
    }
}

$select_admin = "SELECT * FROM admin"; //--- ini querynya
$result = $db->query($select_admin); //--- ini cara manggilnya

$admin = $result->fetch_assoc(); // mencari baris di database
// var_dump($admin);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <div class="super-center">
    <h1>LOGIN ADMIN</h1>
        <i><?= $login_notif ?></i>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="username">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="password">
                <button type="submit" name="login">Login</button>
            </form>
    </div>
</body>
</html>