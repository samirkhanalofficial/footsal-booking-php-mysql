<?php
include("../services/sessionService.php");
include("../services/loginService.php");
include("../services/databaseService.php");
include("../services/adminService.php");
include("../services/bookingService.php");
loginRequiredFootsal();
if ((isset($_GET["id"]))) {
    $id = mysqli_real_escape_string($con, $_GET["id"]);
    $myid = mysqli_real_escape_string($con, $_SESSION["myid"]);
    $deleted = deleteBookingById($id, $myid);
    if ($deleted) {
        header("location:dashboard.php");
    } else {
        echo "Failed to delete";
    }

}
?>