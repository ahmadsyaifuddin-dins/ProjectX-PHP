<?php
date_default_timezone_set("Asia/Ujung_Pandang");
$date = date('m/d/Y h:i:s a', time());
session_start();
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tangkap data yang diinputkan
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $gender = $_POST['gender'];
    $tempat_tgl_lhr = $_POST['ttl'];
    $alamat = $_POST['alamat'];
    $submit = $_POST['submit'];


    // Validasi data yang diinputkan
    if (empty($name) || empty($email) || empty($username) || empty($password) || empty($confirmPassword) || empty($gender) || empty($tempat_tgl_lhr) || empty($alamat)) {
        echo
        "<script> alert('Silakan lengkapi semua field'); </script>";
    } elseif ($password !== $confirmPassword) {
        echo
        "<script> alert('Konfirmasi password tidak sesuai'); </script>";
    } else {
        // Cek duplikasi username
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            echo
            "<script> alert('Username sudah digunakan, silakan pilih username lain.'); </script>";
        } else {
            // Simpan data ke database
            $query = "INSERT INTO users (name, email, username, password, gender, ttl, alamat, submit) VALUES ('$name', '$email', '$username', '$password', '$gender', '$tempat_tgl_lhr', '$alamat', '$submit')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                // Redirect ke halaman login
                header("Location: login.php");
                exit();
                echo "<script> alert('Pendaftaran berhasil, Silahkan Login!'); </script>";
            } else {
                echo "<script> alert('Pendaftaran gagal!'); </script>"  . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style1.css">
    <title>Register</title>



</head>

<body>
    <div class="container">
        <form method="POST" action="register.php">
            <h2>REGISTER</h2>
            <div class="input-group" style="margin-bottom: 10px;">
                <label for="name">Nama Lengkap </label>
                <input type="text" id="name" class="form-control" name="name" required><br>
            </div>

            <div class="input-group" style="margin-bottom: 10px">
                <label for="email">Email </label>
                <input type="email" id="email" name="email" class="form-control" placeholder="unknown@gmail.com" required><br>
            </div>

            <div class="input-group" style="margin-bottom: 10px;">
                <label for="username">Username </label>
                <input type="text" id="username" class="form-control" name="username" required><br>
            </div>

            <div class="input-group" style="margin-bottom: 10px;">
                <label for="password">Password </label>
                <input type="password" id="password" class="form-control" name="password" required><br>
                <button type="button" id="btnToggle" class="toggle">
                    <i id="eyeIcon" class="fa fa-eye"></i>
                </button>
            </div>

            <div class="input-group" style="margin-bottom: 10px;">
                <label for="confirm_password">Konfirmasi Password </label>
                <input type="password" id="confirm_password" class="form-control" name="confirm_password" required><br>
            </div>

            <div class="input-group" style="margin-bottom: 10px;">
                <label for="gender">Jenis Kelamin </label>
                <select id="gender" class="form-control" name="gender" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select><br><br>
            </div>

            <div class="input-group" style="margin-bottom: 10px;">
                <label for="ttl">Tempat dan Tanggal Lahir </label>
                <input type="text" id="ttl" class="form-control" placeholder="Denpasar, 09-Juni-2004" name="ttl" required>
            </div>

            <div class="input-group" style="margin-bottom: 10px;">
                <label for="alamat">Alamat </label>
                <input type="text" id="alamat" class="form-control" name="alamat" required>
            </div>


            <button type="submit" class="btn btn-lg btn-primary btn-block" id="submit_form" name="submit" value=<?php echo date('l/d/M/Y-H:i:s:a'); ?>>R E G I S T E R</button><br>
            <p> <b>Sudah mempunyai akun ?</b> <a href="login.php">Login</a></p>
        </form>

    </div>





    <script>
        $(document).ready(function() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.getElementById('btnToggle');
            const eyeIcon = document.getElementById('eyeIcon');

            toggleButton.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                }
            });

            /**
            $("#submit_form").click(function() {
                var passwordregex = /^(.{0,7}|[^0-9]*|[^A-Z]*|[a-zA-Z0-9]*)$/;
                var emailRegex = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
                var username = $.trim($("#username").val());
                var email = $.trim($("#email").val());
                var Password = $.trim($("#password").val());
                $("#username_error").html("");
                $("#password_error").html("");
                $("#email_error").html("");
                if (username == "") {
                    $("#username").focus();
                    $("#username_error").show();
                    $("#username_error").html("Please Enter Username");
                    return false;
                } else if (email == "") {
                    $("#email").focus();
                    $("#email_error").show();
                    $("#email_error").html("Please Enter Email");
                    return false;
                } else if (!email.match(emailRegex)) {
                    $("#email").focus();
                    $("#email_error").show();
                    $("#email_error").html("Enter Valid Email");
                    return false;
                } else if (Password == "") {
                    $("#password").focus();
                    $("#password_error").show();
                    $("#password_error").html("Please Enter Password");
                    return false;
                } else if (Password.match(passwordregex)) {
                    $("#password").focus();
                    $("#password_error").show();
                    $("#password_error").html(
                        "Make a strong password, 8 characters, including an uppercase letter, number, and one special character."
                    );
                    return false;
                } else {
                    alert("wefw");
                }
            });
             */

        });
    </script>






</body>

</html>