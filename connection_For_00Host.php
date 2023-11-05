<?php
$host = 'localhost';
$username = 'id20865312_ahmadsyaifuddin';
$password = '123PAhmad_DBrumahsakit$';
$database = 'id20865312_rumah_sakit';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
