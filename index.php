<?php
date_default_timezone_set("Asia/Ujung_Pandang");
$date = date('m/d/Y h:i:s a', time());
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

require 'connection.php';

// Mendapatkan informasi user berdasarkan ID yang disimpan dalam session
$userId = $_SESSION['id'];
$query = "SELECT * FROM users WHERE id = '$userId'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Welcome</title>
</head>

<body class="jumbotron jumbotron-fluid">


    <div class="container">
        <h3 class=""> Selamat Datang <?php echo $user["name"]; ?></h3>
        <p class=" lead">Terima kasih <?php echo $user["name"]; ?> telah berpartisipasi dalam Testing ini Pada Tanggal <?php echo date('d-M-Y.'); ?> Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae impedit nihil voluptate. Quis eaque consequuntur mollitia voluptatum aliquam ex delectus, in commodi, minima, quos cupiditate nostrum. Non officia fugiat at. </p>
        <br>
        <p> <b>Mau Melihat Biodata Anda ? Silahkan Tekan dibawah ini </b></p>
        <a href="4041.php">Your Biodata</a>


    </div>

</body>

</html>