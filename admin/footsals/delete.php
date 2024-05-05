<?php
include("../../services/sessionService.php");
include("../../services/loginService.php");
include("../../services/databaseService.php");
include("../../services/footsalService.php");
loginRequired();
if ((isset($_GET["id"]))) {
    $id = mysqli_real_escape_string($con, $_GET["id"]);
    $deleted = deleteFoootsalById($id);
    if ($deleted) {
        header("location:../footsals.php");
    } else {
        echo "Failed to delete";
    }

}
?>