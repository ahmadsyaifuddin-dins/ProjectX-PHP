<?php
$host = 'sql208.infinityfree.com';
$username = 'if0_34535842';
$password = 'ILsrZ75lGFTSA';
$database = 'if0_34535842_rumah_sakit';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
