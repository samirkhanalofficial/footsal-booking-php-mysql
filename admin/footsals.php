<?php
include("../services/sessionService.php");
include("../services/loginService.php");
include("../services/footsalService.php");
loginRequired();
include("nav.php");
?>

<head>
    <title>
        Footsals - FootsalBooking
    </title>
</head>
<style>
.footsals {
    font-weight: bold;
    border-bottom: 2px solid white !important;

}
</style>
<div class="container">
    <div class="row">
        <h2> Footsals </h2>
        <a href="footsals/add.php" class="addButton">
            Add New Footsal
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>sn</th>
                <th>name</th>
                <th>email</th>
                <th>contact</th>
                <th>price (Rs)</th>
                <th>location</th>
                <th>subscription</th>
                <th>Ads status</th>
                <th>action</th>
            </tr>
        </thead>

        <?php
        $footsalcounts = 0;
        $footsals = getALlFootsals();
        while ($footsal = mysqli_fetch_object($footsals)) {
            $footsalcounts++;
            ?>
        <tr>
            <td>
                <?php echo $footsalcounts; ?>
            </td>
            <td>
                <?php echo $footsal->name; ?>
            </td>
            <td>
                <?php echo $footsal->email; ?>
            </td>
            <td>
                <?php echo $footsal->contact; ?>
            </td>
            <td>
                <?php echo $footsal->price; ?>
            </td>
            <td>
                <?php echo $footsal->location; ?>
            </td>
            <td>
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
            </td>
            <td>
                <?php
                    if ($footsal->adsrunning == "false") {
                        echo "<span class='text-warning'> Not running </span>";
                    } else {
                        echo "<span style='color:green;'> running </span>";
                    }
                    ?>
            </td>
            <td>

                <a class="text-primary" href="footsals/edit.php?id=<?php echo $footsal->id; ?>"> Edit </a> |
                <a class="text-warning" href="footsals/delete.php?id=<?php echo $footsal->id; ?>"> Delete </a>

            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>