<?php
include("../services/sessionService.php");
include("../services/databaseService.php");
include("../services/loginService.php");
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

<b> License:</b>
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
        echo "<h2 style='color:red;'>" . date_diff($date1, $date2)->format("expired %a days ago") . "</h2>";
        echo "<span> Please contact admin and renew your subscription. You will be hidden from booking page unless you renew your subscription. </span>";
        return;
    }

} ?>

<head>
    <title>
        Dashboard - FootsalBooking
    </title>
</head>
<style>
.dashboard {
    font-weight: bold;
    border-bottom: 2px solid white !important;

}

.input-holder {
    display: block !important;
    border-radius: 20px;
    background-color: #f9f9f9;
    width: 85% !important;
    overflow-x: hidden;
}

.flex {
    display: flex;
}

.form-field {
    display: block !important;
    padding: 10px 20px;
    margin: 2px;
    border: 0;
    outline: none;
    border-radius: 20px;
    background-color: #f9f9f9;
    overflow: block;
    width: 105% !important;
}
</style>
<form action="verify.php" method="get" class="flex">
    <div class=" input-holder">
        <input type="number" placeholder="booking id" name="id" id="id" class="form-field">

    </div> <button class="addButton">
        Verify
    </button>
</form>
<div class="container">
    <div class="row">
        <h2> Bookings </h2>
        <a href="/book.php?id=<?php echo $_SESSION["myid"]; ?>" class="addButton">
            Add New Bookings
        </a>
    </div>

</div>

<table>
    <thead>
        <tr>
            <th>sn</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Mobile Number</th>
            <th>Action</th>

        </tr>
    </thead>

    <?php
    $myid = mysqli_real_escape_string($con, $_SESSION["myid"]);
    $bookingcounts = 0;
    $bookings = getmyBookedBookings($myid);
    while ($booking = mysqli_fetch_object($bookings)) {
        $bookingcounts++;
        ?>
    <tr>
        <td>
            <?php echo $bookingcounts; ?>
        </td>
        <td>
            <?php echo $booking->date; ?>
        </td>
        <td>
            <?php echo $booking->time; ?>
        </td>
        <td>
            <?php echo $booking->status; ?>
        </td>
        <td>
            <?php echo $booking->phone; ?>
        </td>
        <td>
            <a class="text-warning" href="delete.php?id=<?php echo $booking->id; ?>"> Delete </a>

        </td>
    </tr>
    <?php
    }
    ?>
</table>
</div>