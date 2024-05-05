<?php
include("../../services/sessionService.php");
include("../../services/loginService.php");
include("../../services/databaseService.php");
include("../../services/footsalService.php");
loginRequired();
if (isset($_GET["id"])) {
    $id = mysqli_real_escape_string($con, $_GET["id"]);
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
        <div class="spacer">
            <a href="/admin/footsals.php" class="back"> &lt; back </a> <br>

        </div>
        <center class="mobile-logo">
            <img src="/images/logo.png" class="logo" alt="logo">
        </center>
        <div class="content">


            <div class="right">

            </div>

            <div class="left" style="margin:0 auto;">
                <center class="desktop-logo">
                    <img src="../../images/logo.png" class="logo" alt="logo">
                </center>


                <form action="edit.php?id=<?php echo $id; ?>" method="post">
                    <div class="p-18">
                        <font size="6">Edit Footsal</font><br>
                        Please enter details for edting Footsal.
                        <label for="name" class="bold-text">
                            Footsal Name :

                        </label>
                        <div class="input-holder">
                            <input type="name" value="<?php echo $footsal->name; ?>" placeholder="Full Name" name="name"
                                id="name" class="form-field">
                        </div>
                        <label for="email" class="bold-text">
                            Email :

                        </label>
                        <div class="input-holder">
                            <input type="email" value="<?php echo $footsal->email; ?>" placeholder="example@example.com"
                                name="email" id="email" class="form-field">
                        </div>

                        <label for="contact" class="bold-text">
                            Contact :

                        </label>
                        <div class="input-holder">
                            <input type="tel" value="<?php echo $footsal->contact; ?>" placeholder="eg. 9800000000"
                                name="contact" id="contact" class="form-field">
                        </div>
                        <label for="price" class="bold-text">
                            Price (Rs per hour):

                        </label>
                        <div class="input-holder">
                            <input type="number" value="<?php echo $footsal->price; ?>" placeholder="eg. 300"
                                name="price" id="price" class="form-field">
                        </div>
                        <label for="location" class="bold-text">
                            Location :

                        </label>
                        <div class="input-holder">
                            <input type="text" value="<?php echo $footsal->location; ?>" placeholder="eg. Koteshwor"
                                name="location" id="location" class="form-field">
                        </div>
                        <label for="gmap" class="bold-text">
                            Google Maps :

                        </label>
                        <div class="input-holder">
                            <input type="text" value="<?php echo $footsal->gmap; ?>"
                                placeholder="eg. https://goo.gl/maps/GiD1yp1i4MAZPfyBA" name="gmap" id="gmap"
                                class="form-field">
                        </div>
                        <label for="subscription" class="bold-text">
                            Subscription Until:

                        </label>
                        <div class="input-holder">
                            <input type="date" value="<?php echo $footsal->subscription; ?>" name="subscription"
                                id="subscription" class="form-field">
                        </div>
                        <br>
                        <div>
                            <input <?php if ($footsal->adsrunning == "true") {
                                    echo "checked";
                                } ?> type="checkbox" value="true" name="adsrunning" id="adsrunning"> Run Ads
                            in
                            front Page ?
                        </div>
                        <br>
                        <?php
                            editFootsal();
                            ?>
                        <button name="submit" href="book.php" class="btn">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>

    </html>
    <?php

} else {
    echo "invalid request";
    return;
}
?>