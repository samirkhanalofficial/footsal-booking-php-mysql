<?php

function FootsalLogin()
{
    include("databaseService.php");

    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = mysqli_real_escape_string($con, $_POST["email"]);
        $password = md5(mysqli_real_escape_string($con, $_POST["password"]));
        $query = $con->query("Select * from footsals where email='$email' and password='$password'");
        if (mysqli_num_rows($query) == 1) {
            $row = mysqli_fetch_object($query);
            $_SESSION["footsalemail"] = $email;
            $_SESSION["footsalpassword"] = $password;
            $_SESSION["myid"] = $row->id;
            header("location:dashboard.php");
        } else {
            echo "<span style='color:red;'>The email or password you entered is incorrect.</span>";
        }
    }
}
function login()
{
    include("databaseService.php");

    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = mysqli_real_escape_string($con, $_POST["email"]);
        $password = md5(mysqli_real_escape_string($con, $_POST["password"]));
        $query = $con->query("Select * from admins where email='$email' and password='$password'");
        if (mysqli_num_rows($query) == 1) {
            $_SESSION["adminemail"] = $email;
            $_SESSION["adminpassword"] = $password;
            header("location:footsals.php");
        } else {
            echo "<span style='color:red;'>The email or password you entered is incorrect.</span>";
        }
    }
}
function loginRequired()
{
    include("databaseService.php");

    if (isset($_SESSION["adminemail"]) && isset($_SESSION["adminpassword"])) {
        $email = mysqli_real_escape_string($con, $_SESSION["adminemail"]);
        $password = mysqli_real_escape_string($con, $_SESSION["adminpassword"]);
        $query = $con->query("Select * from admins where email='$email' and password='$password'");
        if (mysqli_num_rows($query) == 1) {

        } else {
            logout();
            echo "<span style='color:red;'>Incorrect email or password. Logging you out.</span>";
            return;
        }
    } else {
        logout();
        echo "<span style='color:red;'>You are not loggined.</span>";
    }
}
function loginRequiredFootsal()
{
    include("databaseService.php");

    if (isset($_SESSION["footsalemail"]) && isset($_SESSION["footsalpassword"])) {
        $email = mysqli_real_escape_string($con, $_SESSION["footsalemail"]);
        $password = mysqli_real_escape_string($con, $_SESSION["footsalpassword"]);
        $query = $con->query("Select * from footsals where email='$email' and password='$password'");
        if (mysqli_num_rows($query) == 1) {

        } else {
            logout();
            echo "<span style='color:red;'>Incorrect email or password. Logging you out.</span>";
            return;
        }
    } else {
        logout();
        echo "<span style='color:red;'>You are not loggined.</span>";
    }
}
function autologin()
{
    include("databaseService.php");

    if (isset($_SESSION["adminemail"]) && isset($_SESSION["adminpassword"])) {
        $email = mysqli_real_escape_string($con, $_SESSION["adminemail"]);
        $password = mysqli_real_escape_string($con, $_SESSION["adminpassword"]);
        $query = $con->query("Select * from admins where email='$email' and password='$password'");
        if (mysqli_num_rows($query) == 1) {
            header("location:footsals.php");
        } else {
            session_destroy();
            echo "<span style='color:red;'>Password has been changed. Please login again</span>";
        }
    }
}
function autologinFootsal()
{
    include("databaseService.php");

    if (isset($_SESSION["footsalemail"]) && isset($_SESSION["footsalpassword"])) {
        $email = mysqli_real_escape_string($con, $_SESSION["footsalemail"]);
        $password = mysqli_real_escape_string($con, $_SESSION["footsalpassword"]);
        $query = $con->query("Select * from footsals where email='$email' and password='$password'");
        if (mysqli_num_rows($query) == 1) {
            header("location:dashboard.php");
        } else {
            session_destroy();
            echo "<span style='color:red;'>Password has been changed. Please login again</span>";
        }
    }
}
function logout()
{
    session_destroy();
    header("location:index.php");
}