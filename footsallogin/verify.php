<?php
include("../services/sessionService.php");
include("../services/loginService.php");
include("../services/databaseService.php");
include("../services/footsalService.php");
include("../services/bookingService.php");
loginRequiredFootsal();
include("nav.php");

if (isset($_SESSION["myid"])) {
    $id = mysqli_real_escape_string($con, $_SESSION["myid"]);
    $footsals = getFoootsalById($id);
    if (mysqli_num_rows($footsals) != 1) {
        echo "this footsal doesnot exists";
        return;
    }
    $footsal = mysqli_fetch_object($footsals);

    ?>
<?php


    if (isset($_SESSION["myid"]) && isset($_GET['id'])) {
        $id = mysqli_real_escape_string($con, $_GET["id"]);
        $fid = mysqli_real_escape_string($con, $_SESSION["myid"]);



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

        } else {
            echo "<center> <h2 class='text-warning'>Booking not found</h2> This booking was not found </center>";
            return exit;
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
    <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/css/book.css">
</head>

<body>
    <div class="spacer"></div>
    <center>
        <img src="/images/logo.png" class="logo" alt="logo">
    </center>
    <div class="content">




        <div class="left">

            <div style="display:flex; align-items:center;">
                <img src="/images/verified.png">
                <div>
                    <b class="bold-text">

                        Booking verified

                    </b>
                    <p>Please check for date & time.

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
                            <?php echo $footsal->name ?>
                        </span>
                    </div>
                    <div>
                        <b> Price : </b> <span>Rs.
                            <?php echo $footsal->price ?>
                        </span>
                    </div>
                    <div>
                        <b> Date : </b> <span>
                            <?php echo $bookedData->date ?>
                        </span>
                    </div>
                    <div>
                        <b> Time : </b> <span>
                            <?php echo $bookedData->time ?>
                        </span>
                    </div>
                    <div>
                        <b> Location : </b> <span>

                            <?php
                            echo $location;
                            ?> | <a href="<?php echo $gmap; ?>">View in Google Map </a>
                        </span>
                    </div>
                    <br>
                    <a class="btn" href="delete.php?id=<?php echo $bookedData->id; ?>"> Verify & delete </a>

                </div>
            </div>

            <br><br><br>

            <b style="color:green;">Verified:</b>
            <ul>
                <li> This booking id is valid & does belongs to your footsal.</li>

            </ul>




        </div>
    </div>
</body>

</html>