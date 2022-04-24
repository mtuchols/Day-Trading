<?php

session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {

        //read from database
        $query = "select * from users where email = '$email' limit 1";
        $result = mysqli_query($con, $query);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {

                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['password'] === $password) {

                    $_SESSION['email'] = $user_data['email'];
                    header("Location: index.php");
                    //die;
                }
            }
        }

        echo "wrong username or password!";
    } else {
        echo "wrong username or password!";
    }
}

?>


<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tech Trading</title>
    <link href="https://fonts.googleapis.com/css?family=Heebo:400,700|Oxygen:700" rel="stylesheet">
    <link rel="stylesheet" href="dist/css/style.css">
    <link rel="stylesheet" href="dist/css/style2.css">
    <script src="https://unpkg.com/scrollreveal@4.0.5/dist/scrollreveal.min.js"></script>
</head>

<body class="is-boxed has-animations">
    <div class="body-wrap boxed-container">
        <header class="site-header text-light">
            <div class="container">
                <div class="site-header-inner">
                    <div class="brand header-brand">
                        <h1 class="m-0">
                            <a href="#">
                                <img class="header-logo-image" src="dist/images/logo.svg" alt="Logo">
                            </a>
                        </h1>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <section class="hero text-center text-light">
                <div class="hero-bg"></div>
                <div class="hero-particles-container">
                    <canvas id="hero-particles"></canvas>
                </div>
                <div class="container-sm">
                    <div class="hero-inner">
                        <div class="hero-copy">
                            <center> <img class="header-logo-image" src="dist/images/logo.png" alt="Logo"> </center>
                            <div class="hero-cta">
                                <br>
                                <button class="button button-primary button-wide-mobile" onclick="openLoginForm()">Login</button>
                                <div class="form-popup" id="myForm2">
                                    <form method="post" class="form-container">
                                        <h1>Login</h1>
                                        <label for="email"><b>Email</b></label>
                                        <input id="text" type="text" name="email" placeholder="Enter Email"><br><br>
                                        <label for="psw"><b>Password</b></label>
                                        <input id="text" type="password" name="password" placeholder="Enter Password"><br><br>

                                        <input id="button" type="submit" value="Login" class="btn"><br><br>
                                        <button type="button" class="btn cancel" onclick="closeLoginForm()">Close</button>

                                        <a href="signup.php">Click to Signup</a><br><br>
                                    </form>
                                </div>
                            </div>
                            <script>
                                function openRegisterForm() {
                                    document.getElementById("myForm").style.display = "block";
                                }

                                function closeRegisterForm() {
                                    document.getElementById("myForm").style.display = "none";
                                }

                                function openLoginForm() {
                                    document.getElementById("myForm2").style.display = "block";
                                }

                                function closeLoginForm() {
                                    document.getElementById("myForm2").style.display = "none";
                                }
                            </script>
                        </div>
                        <div class="mockup-container">
                            <div class="mockup-bg">
                                <img src="dist/images/iphone-hero-bg.svg" alt="iPhone illustration">
                            </div>
                            <img class="device-mockup" src="dist/images/iphone-hero.png" alt="iPhone Hero">
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <footer class="site-footer">
            <div class="footer-particles-container">
                <canvas id="footer-particles"></canvas>
            </div>

            <div class="site-footer-bottom">
                <div class="container">
                    <div class="site-footer-inner">
                        <div class="brand footer-brand">
                            <a href="#">
                            </a>
                        </div>
                        <div class="footer-copyright">&copy; 2022 Tucholski and Dorazio, all rights reserved</div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="dist/js/main.min.js"></script>
</body>

</html>