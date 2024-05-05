<?php

function addFootsal()
{
    include("databaseService.php");
    if ((isset($_POST["submit"]))) {
        $email = mysqli_real_escape_string($con, $_POST["email"]);
        $name = mysqli_real_escape_string($con, $_POST["name"]);
        $password = mysqli_real_escape_string($con, $_POST["password"]);
        $confirmPassword = mysqli_real_escape_string($con, $_POST["confirmPassword"]);
        $contact = mysqli_real_escape_string($con, $_POST["contact"]);
        $location = mysqli_real_escape_string($con, $_POST["location"]);
        $price = mysqli_real_escape_string($con, $_POST["price"]);
        $gmap = mysqli_real_escape_string($con, $_POST["gmap"]);
        $subscription = mysqli_real_escape_string($con, $_POST["subscription"]);
        $password = md5($password);
        $confirmPassword = md5($confirmPassword);
        $query = $con->query("Select * from footsals where email='$email'");
        if (mysqli_num_rows($query) == 1) {
            echo "<span style='color:red;'>The email already exists.</span>";
            return;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<span style='color:red;'>Invalid email format.</span>";
            return;
        }
        if (strlen($name) < 3) {
            echo "<span style='color:red;'>Full Name must be atleast 3 characters long.</span>";
            return;
        }
        if (strlen($location) < 2) {
            echo "<span style='color:red;'>Location must be atleast 2 characters long.</span>";
            return;
        }
        if ($price < 1) {
            echo "<span style='color:red;'>Price must be positive number.</span>";
            return;
        }
        if (strlen($password) < 8) {
            echo "<span style='color:red;'>Password must be atleast 8 characters long.</span>";
            return;
        }

        if ($password != $confirmPassword) {
            echo "<span style='color:red;'>Confirm password didn't match.</span>";
            return;
        }



        $newfootsal = $con->query("insert into footsals(name,email,password,location,gmap,price,contact,subscription) VALUES ('$name','$email','$password','$location','$gmap','$price','$contact','$subscription')");
        if ($newfootsal) {
            echo "<span style='color:green;'>footsal added successfully .</span>";


        } else {
            echo "<span style='color:red;'>Error adding footsal.</span>";

        }

    }
}
function editFootsal()
{
    include("databaseService.php");
    if ((isset($_POST["submit"]))) {

        $id = mysqli_real_escape_string($con, $_GET["id"]);
        $email = mysqli_real_escape_string($con, $_POST["email"]);
        $name = mysqli_real_escape_string($con, $_POST["name"]);
        $contact = mysqli_real_escape_string($con, $_POST["contact"]);
        $location = mysqli_real_escape_string($con, $_POST["location"]);
        $price = mysqli_real_escape_string($con, $_POST["price"]);
        $gmap = mysqli_real_escape_string($con, $_POST["gmap"]);
        $subscription = mysqli_real_escape_string($con, $_POST["subscription"]);
        if (isset($_POST["adsrunning"])) {
            $adsrunning = "true";
        } else {
            $adsrunning = "false";

        }

        $footsals = getFoootsalById($id);
        if (mysqli_num_rows($footsals) != 1) {
            echo "this footsal doesnot exists";
            return;
        }
        $footsal = mysqli_fetch_object($footsals);
        if ($footsal->email != $email) {
            $query = $con->query("Select * from footsals where email='$email'");
            if (mysqli_num_rows($query) == 1) {
                echo "<span style='color:red;'>The email already exists.</span>";
                return;
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<span style='color:red;'>Invalid email format.</span>";
                return;
            }
        }


        if (strlen($name) < 3) {
            echo "<span style='color:red;'>Full Name must be atleast 3 characters long.</span>";
            return;
        }
        if (strlen($location) < 2) {
            echo "<span style='color:red;'>Location must be atleast 2 characters long.</span>";
            return;
        }
        if ($price < 1) {
            echo "<span style='color:red;'>Price must be positive number.</span>";
            return;
        }



        $newfootsal = $con->query("update footsals set email='$email',name='$name',contact='$contact',price='$price',location='$location',gmap='$gmap',subscription='$subscription',adsrunning='$adsrunning' where id='$id'");
        if ($newfootsal) {
            echo "<span style='color:green;'>footsal updated successfully .</span>";


        } else {
            echo "<span style='color:red;'>Error updating footsal.</span>";

        }

    }
}
function getAllFootsals()
{
    include("databaseService.php");
    $admins = $con->query("select * from footsals");
    return $admins;
}
function deleteFoootsalById($id)
{
    include("databaseService.php");
    $deleted = $con->query("delete from footsals WHERE id='$id'");
    return $deleted;
}

function getFoootsalById($id)
{
    include("databaseService.php");
    $footsal = $con->query("select * from footsals WHERE id='$id'");

    return $footsal;
}

?>