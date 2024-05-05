<?php
include("../../services/sessionService.php");
include("../../services/loginService.php");
include("../../services/databaseService.php");
include("../../services/adminService.php");
loginRequired();
if ((isset($_GET["id"]))) {
    $id = mysqli_real_escape_string($con, $_GET["id"]);
    $deleted = deleteAdminById($id);
    if ($deleted) {
        header("location:../admins.php");
    } else {
        echo "Failed to delete";
    }

}
?>