<?php
require 'connection.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tangkap data yang diinputkan
    $emailOrUsername = $_POST['email_or_username'];
    $password = $_POST['password'];

    // Cek apakah email atau username terdapat dalam database
    $query = "SELECT * FROM users WHERE email = '$emailOrUsername' OR username = '$emailOrUsername'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION['login'] = true;
        $_SESSION['id'] = $user['id'];

        // Cek kesesuaian password
        if ($password === $user['password']) {
            // Login berhasil
            // Redirect ke halaman dashboard atau halaman lain yang sesuai
            header("Location: index.php");
            exit;
        } else {
            echo
            "<script>alert ('Password salah!'); </script> ";
        }
    } else {
        echo
        "<script>alert ('Email atau username tidak ditemukan!'); </script> ";
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
    <title>Login</title>
</head>

<body>

    <style>
        html,
        body {
            width: 100%;
            height: 100%;
        }

        body {
            background: #efefef;
            font: 14px/1 "Roboto", sans-serif;
            background-image: url("https://lh3.googleusercontent.com/proxy/2opyTBEESV8lsgMCMewfC0Fc3u4Q1BLlwbQQ8CgS9AfKhcPeYPL079EJegkI_Axg2MAyOTAZzbgjjPCV2cFlJkzOuGgbF_nZzOkZPVYxH4EUQlHgCDI_Z-RmTVXb4CHU6VC-vAlNnEY6FJF8Te81T4vpH3xx0Sy4A-JRosBocqbLGw");
            background-repeat: no-repeat;
            background-size: cover;
        }

        main {
            -ms-flex-align: center;
            align-items: center;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: center;
            height: 100%;
        }

        .container {
            margin: 0 auto;
        }

        form {
            background: #fff;
            border-top: 1px solid rgba(0, 0, 0, 0.08);
            border-right: 1px solid rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(0, 0, 0, 0.12);
            border-left: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 3rem 5rem -2rem rgba(0, 0, 0, 0.2);
            margin: 0 auto;
            max-width: 380px;
            padding: 15px 35px 45px;
        }

        h2 {
            color: rgb(18, 138, 78);
            margin-bottom: 0.75em;
            text-align: center;
            font-weight: bold;
        }

        .input-group {
            margin-bottom: 1.25em;
        }

        input[type="text"],
        input[type="password"] {
            -webkit-appearance: none;
            border-radius: 1px;
            box-sizing: border-box;
            font-size: 1.25em;
            height: auto;
            padding: 0.5em;
        }

        /* suppress IE >= 10 native functionality that can show password */
        input[type="password"]::-ms-reveal {
            display: none;
        }

        .btn {
            margin-top: 1.75em;
            background: rgb(18, 138, 78);
        }

        .btn:hover {
            background: rgb(12, 109, 61);
        }

        #eyeIcon {
            color: rgb(44, 52, 63);
        }

        .input-group {
            position: relative;
            width: 100%;
        }

        .toggle {
            background: none;
            border: none;
            color: #337ab7;
            /*display: none;*/
            /*font-size: .9em;*/
            font-weight: 600;
            /*padding: .5em;*/
            position: absolute;
            right: 0.75em;
            top: 2.25em;
            z-index: 9;
        }

        .fa {
            font-size: 2rem;
        }
    </style>

    <main>

        <div class="container">
            <form method="POST" action="login.php">
                <h2>LOGIN</h2>
                <div class="input-group">
                    <label for="email_or_username">Email atau Username </label>
                    <input type="text" id="email_or_username" class="form-control" name="email_or_username" required><br>
                </div>

                <div class="input-group">
                    <label for="password">Password </label>
                    <input type="password" class="form-control" id="password" name="password" required><br>
                    <button type="button" id="btnToggle" class="toggle">
                        <i id="eyeIcon" class="fa fa-eye"></i>
                    </button>
                </div>

                <input type="submit" class="btn btn-lg btn-primary btn-block" id="submit-form" value="L O G I N">
                <p> <br> <b>Belum mempunyai akun ?</b> <a href="register.php">Register</a></p>
            </form>
        </div>
    </main>








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
        });
    </script>




</body>

</html>