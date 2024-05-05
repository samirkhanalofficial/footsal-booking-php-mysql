<?php
function addBooking()
{
    include("databaseService.php");
    if (isset($_GET['id']) && isset($_GET['date']) && isset($_POST['time']) && isset($_POST["phone"])) {
        $id = mysqli_real_escape_string($con, $_GET["id"]);
        $date = mysqli_real_escape_string($con, $_GET["date"]);
        $time = mysqli_real_escape_string($con, $_POST["time"]);
        $number = mysqli_real_escape_string($con, $_POST["phone"]);
        if (trim($time) == "" || trim($id) == "" || trim($date) == "0000-00-00" || trim($date) == "" || strlen($number)<10 || strlen($number)>10) {
            echo "<span style='color:red;'>Invalid details.</span>";
            return;
        }
        $getfootsal = getFoootsalById($id);
        $footsal = mysqli_fetch_object($getfootsal);
        if (mysqli_num_rows($getfootsal) != 1) {
            echo "<span style='color:red;'>Footsal doesnot exists.</span>";
            return;
        }
        $query = $con->query("Select * from bookings where footsal='$id' and date='$date' and time='$time'");
        if (mysqli_num_rows($query) == 1) {
            echo "<span style='color:red;'>This time has already been booked. Please select another</span>";
            return;
        }
        $newbooking = $con->query("insert into bookings(footsal,date,time,phone) VALUES ('$id','$date','$time','$number')");


        if ($newbooking) {
            ?>
<script>
window.location =
    "booked.php?fid=<?php echo $id; ?>&id=<?php echo $con->insert_id; ?>&footsal=<?php echo $footsal->name; ?>&price=<?php echo $footsal->price; ?>&date=<?php echo $date; ?>&time=<?php echo $time; ?>";
</script>
<?php


        } else {
            echo "<span style='color:red;'>Error booking footsal.</span>";

        }

    }
}
function deleteBookingById($id,$myid)
{
    include("databaseService.php");
    $deleted = $con->query("delete from bookings WHERE id='$id' and footsal='$myid'");
    return $deleted;
}
function getBookedBookings()
{
    include("databaseService.php");
    if (isset($_GET['id']) && isset($_GET['date'])) {
        $id = mysqli_real_escape_string($con, $_GET["id"]);
        $date = mysqli_real_escape_string($con, $_GET["date"]);

        if (trim($id) == "" || trim($date) == "0000-00-00" || trim($date) == "") {
            echo "<span style='color:red;'>Invalid details.</span>";
            return;
        }
        $getfootsal = getFoootsalById($id);
        if (mysqli_num_rows($getfootsal) != 1) {
            echo "<span style='color:red;'>Footsal doesnot exists.</span>";
            return;
        }
        $query = $con->query("Select * from bookings where footsal='$id' and date='$date'");
        return $query;

    }
}

function getmyBookedBookings($id)
{
    include("databaseService.php");
    $query = $con->query("Select * from bookings where footsal='$id' ORDER BY date DESC");
    return $query;


}

function getBookedBookingByID($id)
{
    include("databaseService.php");
    $query = $con->query("Select * from bookings where id='$id'");
    return $query;


}