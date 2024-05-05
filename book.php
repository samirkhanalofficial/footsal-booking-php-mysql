<?php
include("services/sessionService.php");
include("services/footsalService.php");
include("services/databaseService.php");
include("services/bookingService.php");
$time = array("7 am - 8 am", "8 am - 9 am", "9 am - 10 am", "10 am - 11 am", "11 am - 12 pm", "12 pm - 1 pm", "1 pm - 2 pm", "2 pm - 3 pm", "3 pm - 4 pm", "4 pm - 5 pm", "5 pm - 6 pm", "6 pm - 7 pm");

$idd = "";
if (isset($_GET["id"])) {
    $idd = mysqli_real_escape_string($con, $_GET['id']);
}
$footsals = getAllFootsals();
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Book best Footsals- Footsal Booking</title>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/book.css">
</head>

<body>
    <div class="spacer"></div>
    <center class="mobile-logo">
        <img src="./images/logo.png" class="logo" alt="logo">
    </center>
    <div class="content">


        <div class="right">

            <div class="highlightedText text1">
                <span>
                    Our Best
                </span> Footsals
                <div class="slide-wrapper">
                    <div class="slider">


                        <?php
                        $i = 0;
                        while ($footsal = mysqli_fetch_object($footsals)) {
                            if ($footsal->adsrunning == "true") {
                                $i++;
                                if ($i <= 4) {


                        ?>

                                    <a href="book.php?id=<?php echo $footsal->id; ?>" style="display:flex-box;text-decoration:none;cursor:pointer;" class="slide">
                                        <img class="slide-image" src="images/ad1.jpg" alt="advertisemnt 1">
                                        <div class="wrapper">
                                            <div>
                                                <img src="images/location.svg" alt="">
                                                <span>
                                                    <?php echo $footsal->name; ?>
                                                </span>
                                            </div>
                                            <div>
                                                <img src="images/cash.svg" alt="">
                                                <span>
                                                    <?php echo $footsal->price; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                <?php
                                }
                            }
                        }
                        if ($i < 4) {
                            for ($j = $i; $j <= 3; $j++) {
                                ?>
                                <div style="display:flex-box;text-decoration:none;cursor:pointer;" class="slide">
                                    <img class="slide-image" src="images/ad1.jpg" alt="advertisemnt 1">
                                    <div class="wrapper">
                                        <div>
                                            <img src="images/location.svg" alt="">
                                            <span>
                                                Advertise Here
                                            </span>
                                        </div>
                                        <div>
                                            <img width="14px" src="images/call.png" alt="">
                                            <span>
                                                9800000000
                                            </span>
                                        </div>
                                    </div>
                                </div>

                        <?php
                            }
                        }

                        ?>


                    </div>

                </div>
            </div>
            <p align="right">
                <a class="link" href="admin">Admin Login </a> | <a class="link" href="footsallogin">Footsal Login</a>
            </p>
        </div>

        <div class="left">
            <center class="desktop-logo">
                <img src="./images/logo.png" class="logo" alt="logo">
            </center>

            <?php
            if (isset($_GET['id'])) {
                echo '<a class="link" href="/" class="back"> &lt; back </a> <br>';
            }
            ?>
            <form action="<?php if ($idd != "" && isset($_GET["date"])) {
                                echo 'book.php?id=' . $idd . '&date=' . $_GET['date'];
                            } else {
                                echo 'book.php';
                            } ?>" method="<?php if ($idd != "" && isset($_GET["date"])) {
                                                echo 'post';
                                            } else {
                                                echo 'get';
                                            } ?>" class="p-18">

                Choose your preferred footsal.
                <label for="id" class="bold-text">
                    Footsal Name :

                </label>
                <div class="input-holder">


                    <select <?php if ($idd != "" && isset($_GET["date"])) {
                                echo "disabled";
                            } ?> class="form-field" name="id" id="id">
                        <option value="">Select a Footsal</option>
                        <?php

                        $footsals = getAllFootsals();
                        while ($footsal = mysqli_fetch_object($footsals)) {
                            $id = $footsal->id;
                            $name = $footsal->name;
                            $price = $footsal->price;

                            $today = date("Ymd");
                            $subscription = $footsal->subscription;
                            $subscription = str_replace("-", "", $subscription);
                            $subscription = str_replace("/", "", $subscription);
                            if ($today <= $subscription) {

                                if ($id == $idd) {

                                    echo "<option selected value='$id'>$name, Rs. $price</option>";
                                } else {

                                    echo "<option value='$id'>$name, Rs. $price</option>";
                                }
                            }
                        }
                        ?>

                    </select>
                </div>
                <label for="date" class="bold-text">
                    Date (AD ):
                </label>
                <div class="input-holder">
                    <input type="date" <?php if ($idd != "" && isset($_GET['date'])) {
                                            echo 'disabled ';
                                            echo 'value=' . $_GET['date'];
                                        } ?> style="width:87%!important;" placeholder="2023-08-03" name="date" id="date" class="form-field">
                </div>
                <?php
                $booked = array();
                if (isset($_GET["id"]) && isset($_GET["date"])) {
                    $getbookings = getBookedBookings();

                    while ($row = mysqli_fetch_object($getbookings)) {
                        array_push($booked, $row);
                    }
                ?>
                    <label for="phone" class="bold-text">
                        Mobile Number:
                    </label>
                    <div class="input-holder">
                        <input type="number" style="width:100%!important;" maxlength="10" placeholder="9800000000" name="phone" id="phone" class="form-field">
                    </div>
                    <label for="time" class="bold-text">
                        Time :
                    </label>
                    <div class="input-holder">
                        <select class="form-field" name="time" id="time">
                            <option value="">Select a Time</option>
                            <?php
                            function contains($where, $what)
                            {
                                $contain = false;
                                for ($j = 0; $j < count($where); $j++) {
                                    if ($where[$j]->time == $what) {
                                        $contain = true;
                                    }
                                }

                                return $contain;
                            }
                            for ($i = 0; $i < count($time); $i++) {
                                if (!contains($booked, $time[$i])) {
                            ?>
                                    <option value="<?php echo $time[$i]; ?>"><?php echo $time[$i]; ?></option>
                            <?php

                                }
                            }
                            ?>

                        </select>
                    </div>

                <?php
                }
                ?>
                <br>
                <?php
                addBooking();
                ?>
                <button href="book.php" class="btn">
                    <?php
                    if (isset($_GET['date'])) {
                        $getfootsal = getFoootsalById($idd);
                        $footsal = mysqli_fetch_object($getfootsal);
                        echo "Book Rs. " . $footsal->price;
                    } else {
                        echo "Next";
                    }
                    ?>
                </button>
            </form>

        </div>
    </div>
    <style>
        .link {
            color: #31b2f1 !important;
        }
        @media only screen and (max-width: 600px) {
           .link{
                display:none;
           }
        }

        .link:hover {
            color: blue;
        }

        .link:active {
            color: red;
        }
    </style>
</body>

</html>