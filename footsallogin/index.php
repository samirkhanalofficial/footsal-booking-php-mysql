<?php
include("../services/sessionService.php");
include("../services/loginService.php");
autologinFootsal();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Footsal Login - Footsal Booking</title>
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/book.css">
</head>

<body>
<div class="spacer">
            <a class="link" href="/" class="back"> &lt; back </a> <br>

        </div>
    <center class="mobile-logo">
        <img src="../images/logo.png" class="logo" alt="logo">
    </center>
    <div class="content">


        <div class="right">

        </div>

        <div class="left" style="margin:0 auto;">
            <center class="desktop-logo">
                <img src="../images/logo.png" class="logo" alt="logo">
            </center>


            <form action="index.php" method="post">
                <div class="p-18">
                    Please enter your footsal details.
                    <label for="email" class="bold-text">
                        Email :

                    </label>
                    <div class="input-holder">
                        <input type="email" placeholder="example@example.com" name="email" id="email"
                            class="form-field">
                    </div>
                    <label for="password" class="bold-text">
                        Password :

                    </label>
                    <div class="input-holder">
                        <input type="password" placeholder="********" name="password" id="password" class="form-field">
                    </div>

                    <br>
                    <?php
                    Footsallogin();
                    ?>
                    <button href="book.php" class="btn">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
    <style>
        .link {
            color: #31b2f1 !important;
        }
        .link:hover{
            color:blue;
        }
        .link:active{
            color:red;
        }
    </style>
</body>

</html>