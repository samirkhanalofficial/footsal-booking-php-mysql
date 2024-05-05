<?php



function addAdmin()
{
    include("databaseService.php");
    if ((isset($_POST["submit"]))) {
        $email = mysqli_real_escape_string($con, $_POST["email"]);
        $name = mysqli_real_escape_string($con, $_POST["name"]);
        $password = mysqli_real_escape_string($con, $_POST["password"]);
        $confirmPassword = mysqli_real_escape_string($con, $_POST["confirmPassword"]);
        $password = md5($password);
        $confirmPassword = md5($confirmPassword);
        $query = $con->query("Select * from admins where email='$email'");
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
        if (strlen($password) < 8) {
            echo "<span style='color:red;'>Password must be atleast 8 characters long.</span>";
            return;
        }

        if ($password != $confirmPassword) {
            echo "<span style='color:red;'>Confirm password didn't match.</span>";
            return;
        }



        $newadmin = $con->query("insert into admins(name,email,password) VALUES ('$name','$email','$password')");
        if ($newadmin) {
            header("location:../admins.php");

        } else {
            echo "<span style='color:red;'>Error adding admin.</span>";

        }

    }
}
function getAllAdmins()
{
    include("databaseService.php");
    $admins = $con->query("select * from admins");
    return $admins;
}
function deleteAdminById($id)
{
    include("databaseService.php");
    $deleted = $con->query("delete from admins WHERE id='$id'");
    return $deleted;
}