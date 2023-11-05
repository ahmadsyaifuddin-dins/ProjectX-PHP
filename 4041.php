<?php
session_start();


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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="4041.css">
    <title>Document</title>
</head>

<body>

    <div class="noise"></div>
    <div class="overlay"></div>
    <div class="terminal">
        <h1> 👀 <span class="errorcode">BIODATA ANDA</span></h1>
        <p>Welcome, <?php echo $user['username']; ?>! </p>
        <p>Email Anda: <?php echo $user['email']; ?></p>
        <p>Nama Lengkap Anda: <?php echo $user['name']; ?></p>
        <p>Jenis Kelamin Anda: <?php echo $user['gender']; ?></p>
        <p>Tempat dan Tanggal lahir Anda: <?php echo $user['ttl']; ?></p>
        <p>Alamat Anda: <?php echo $user['alamat']; ?></p>
        </p>
        <p class="output">Back to Login Page <a href="logout.php">Go back</a> or Back to <a href="index.php">Dashboard</a> </p>
        <p class="output">Good luck.</p>
    </div>

</body>

</html>