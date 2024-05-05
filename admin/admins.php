<?php
include("../services/sessionService.php");
include("../services/loginService.php");
include("../services/adminService.php");
loginRequired();
include("nav.php");
?>

<head>
    <title>
        Admins - FootsalBooking
    </title>
</head>
<style>
.admins {
    font-weight: bold;
    border-bottom: 2px solid white !important;

}
</style>
<div class="container">
    <div class="row">
        <h2>Admins </h2>
        <a href="admins/add.php" class="addButton">
            Add New Admin
        </a>
    </div>

    <table>
        <thead>
            <tr>
                <th>sn</th>
                <th>name</th>
                <th>email</th>
                <th>action</th>
            </tr>
        </thead>

        <?php
        $admincount = 0;
        $admins = getAllAdmins();
        while ($admin = mysqli_fetch_object($admins)) {
            $admincount++;
            ?>
        <tr>
            <td>
                <?php echo $admincount; ?>
            </td>
            <td>
                <?php echo $admin->name; ?>
            </td>
            <td>
                <?php echo $admin->email; ?>
            </td>
            <td>
                <?php
                    if ($admin->email != $_SESSION["adminemail"]) {
                        ?>
                <a class="text-warning" href="admins/delete.php?id=<?php echo $admin->id; ?>"> Delete </a>
                <?php
                    } else {
                        echo "you cannot remove yourself.";
                    }
                    ?>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>