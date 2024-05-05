<?php
include("services/sessionService.php");
include("services/databaseService.php");
include("services/bookingService.php");
include("services/footsalService.php");
$location = "";
$gmap = "";
if (isset($_GET["id"])) {
    $id = mysqli_real_escape_string($con, $_GET["id"]);
    $fid = mysqli_real_escape_string($con, $_GET["fid"]);
    $footsal = mysqli_real_escape_string($con, $_GET["footsal"]);
    $price = mysqli_real_escape_string($con, $_GET["price"]);
    $date = mysqli_real_escape_string($con, $_GET["date"]);
    $time = mysqli_real_escape_string($con, $_GET["time"]);


    $booked = getBookedBookingByID($id);
    if (mysqli_num_rows($booked) == 1) {
        $getfootsal = getFoootsalById($fid);

        if (mysqli_num_rows($getfootsal) != 1) {
            echo "<span style='color:red;'>Invalid order.</span>";
            return;
        }
        $footsall = mysqli_fetch_object($getfootsal);
        $bookedData = mysqli_fetch_object($booked);
        $location = $footsall->location;
        $gmap = $footsall->gmap;
        if ($bookedData->date != $date || $bookedData->time != $time || $footsall->name !== $footsal) {
            echo "<span style='color:red;'>Invalid order.</span>";
            return;
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Booking Success - Footsal Booking</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/book.css">
</head>
<style>
    .logo-details{
        display:flex; align-items:center;
    }
    @media only screen and (max-width: 600px) {
        .logo-details{
        display:block; align-items:center;
    }
    }
</style>
<body>
    <div class="spacer"></div>
    <center>
        <img src="./images/logo.png" class="logo" alt="logo">
    </center>
    <div class="content">




        <div class="left">

            <div class="logo-details" >
                <img src="/images/Verified.png">
                <div>
                    <b class="bold-text">

                        Booking Success

                    </b>
                    <p>Please take a screenshot of this page. You will have to show this on the footsal.

                    </p>
                    <div>
                        <b> Booking ID: </b> <span>
                            <?php if (isset($_GET["id"])) {
                                echo $_GET["id"];
                            } ?>
                        </span>
                    </div>
                    <div>
                        <b> Footsal Name : </b> <span>
                            <?php if (isset($_GET["footsal"])) {
                                echo $_GET["footsal"];
                            } ?>
                        </span>
                    </div>
                    <div>
                        <b> Price : </b> <span>Rs.
                            <?php if (isset($_GET["price"])) {
                                echo $_GET["price"];
                            } ?>
                        </span>
                    </div>
                    <div>
                        <b> Date : </b> <span>
                            <?php if (isset($_GET["date"])) {
                                echo $_GET["date"];
                            } ?>
                        </span>
                    </div>
                    <div>
                        <b> Time : </b> <span>
                            <?php if (isset($_GET["time"])) {
                                echo $_GET["time"];
                            } ?>
                        </span>
                    </div>
                    <div>
                        <b> Location : </b> <span>

                            <?php
                            echo $location;
                            ?> | <a href="<?php echo $gmap; ?>">View in Google Map </a>
                        </span>
                    </div>
                </div>
            </div>

            <br><br><br>

            <b>Note:</b>
            <ul>
                <li> You must reach the Footsal 30min before your booked time.</li>
                <li> Don't share with anyone. If same bill is taken by 2person, first one to reach will be accepted
                </li>
            </ul>



        </div>
    </div>
</body>

</html>