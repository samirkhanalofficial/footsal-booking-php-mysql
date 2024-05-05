<?php
include("../../services/sessionService.php");
include("../../services/loginService.php");
include("../../services/databaseService.php");
include("../../services/adminService.php");
loginRequired();

?>
<div class="container">

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Add Admin - Footsal Booking</title>
        <link rel="shortcut icon" href="../../images/logo.png" type="image/x-icon">
        <link rel="stylesheet" href="../../css/book.css">
        <link rel="stylesheet" href="/css/global.css" />

    </head>

    <body>
        <div class="spacer">
            <a href="/admin/admins.php" class="back"> &lt; back </a> <br>

        </div>
        <center class="mobile-logo">
            <img src="../../images/logo.png" class="logo" alt="logo">
        </center>
        <div class="content">


            <div class="right">

            </div>

            <div class="left" style="margin:0 auto;">
                <center class="desktop-logo">
                    <img src="../../images/logo.png" class="logo" alt="logo">
                </center>


                <form action="add.php" method="post">
                    <div class="p-18">

                        <font size="6">Add New Admin</font><br>
                        Please enter details for new admin.
                        <label for="name" class="bold-text">
                            Full Name :

                        </label>
                        <div class="input-holder">
                            <input type="name" placeholder="Full Name" name="name" id="name" class="form-field">
                        </div>
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
                            <input type="password" placeholder="********" name="password" id="password"
                                class="form-field">
                        </div>

                        <label for="confirmPassword" class="bold-text">
                            Confirm Password :

                        </label>
                        <div class="input-holder">
                            <input type="password" placeholder="********" name="confirmPassword" id="confirmPassword"
                                class="form-field">
                        </div>
                        <br>
                        <?php
                        addAdmin();
                        ?>
                        <button name="submit" href="book.php" class="btn">
                            Add Admin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>

    </html>