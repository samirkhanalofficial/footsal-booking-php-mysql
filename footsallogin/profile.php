<?php
include("../services/sessionService.php");
include("../services/loginService.php");
include("../services/databaseService.php");
include("../services/footsalService.php");
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
    <div class="container">

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title> Edit Footsal - Footsal Booking</title>
            <link rel="icon" href="/images/logo.png" />
            <link rel="stylesheet" href="/css/book.css" />
            <link rel="stylesheet" href="/css/global.css" />
        </head>

        <body>

            <div class="content">


                <div class="right">

                </div>

                <div class="left" style="margin:0 auto;">
                    <center class="desktop-logo">
                        <img src="../../images/logo.png" class="logo" alt="logo">
                    </center>


                    License:
                    <?php

                    $today = date("Ymd");
                    $subscription = $footsal->subscription;
                    $subscription = str_replace("-", "", $subscription);
                    $subscription = str_replace("/", "", $subscription);
                    if ($today <= $subscription) {
                        $date1 = date_create_from_format("Ymd", $subscription);
                        $date2 = date_create_from_format("Ymd", $today);
                        echo "<span style='color:green;'>" . date_diff($date2, $date1)->format("%a days remaining") . "</span>";
                    } else {
                        $date1 = date_create_from_format("Ymd", $subscription);
                        $date2 = date_create_from_format("Ymd", $today);
                        echo "<span style='color:red;'>" . date_diff($date1, $date2)->format("expired %a days ago") . "</span>";
                    }


                    ?>
                    <div class="p-18">
                        <font size="6">Footsal Details</font><br>
                        To change details please contact admin.
                        <label for="name" class="bold-text">
                            Footsal Name :

                        </label>
                        <div class="input-holder">
                            <input disabled type="name" value="<?php echo $footsal->name; ?>" placeholder="Full Name"
                                name="name" id="name" class="form-field">
                        </div>
                        <label for="email" class="bold-text">
                            Email :

                        </label>
                        <div class="input-holder">
                            <input disabled type="email" value="<?php echo $footsal->email; ?>"
                                placeholder="example@example.com" name="email" id="email" class="form-field">
                        </div>

                        <label for="contact" class="bold-text">
                            Contact :

                        </label>
                        <div class="input-holder">
                            <input disabled type="tel" value="<?php echo $footsal->contact; ?>" placeholder="eg. 9800000000"
                                name="contact" id="contact" class="form-field">
                        </div>
                        <label for="price" class="bold-text">
                            Price (Rs per hour):

                        </label>
                        <div class="input-holder">
                            <input disabled type="number" value="<?php echo $footsal->price; ?>" placeholder="eg. 300"
                                name="price" id="price" class="form-field">
                        </div>
                        <label for="location" class="bold-text">
                            Location :

                        </label>
                        <div class="input-holder">
                            <input disabled type="text" value="<?php echo $footsal->location; ?>"
                                placeholder="eg. Koteshwor" name="location" id="location" class="form-field">
                        </div>
                        <label for="gmap" class="bold-text">
                            Google Maps : <a href="<?php echo $footsal->gmap; ?>"> View in Map </a>

                        </label>
                        <div class="input-holder">
                            <input disabled type="text" value="<?php echo $footsal->gmap; ?>"
                                placeholder="eg. https://goo.gl/maps/GiD1yp1i4MAZPfyBA" name="gmap" id="gmap"
                                class="form-field">
                        </div>
                        <label for="subscription" class="bold-text">
                            Subscription Until:

                        </label>
                        <div class="input-holder">
                            <input disabled type="date" value="<?php echo $footsal->subscription; ?>" name="subscription"
                                id="subscription" class="form-field">
                        </div>
                        <br>


                    </div>
                    </form>
                </div>
            </div>
            <style>
                .profile {
                    font-weight: bold;
                    border-bottom: 2px solid white !important;

                }
            </style>
        </body>

        </html>
        <?php

} else {
    echo "invalid request";
    return;
}
?>