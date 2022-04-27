<?php

session_start();

include("connection.php");
include("functions.php");


$user_id = $_SESSION['user_id'];
//read from database
$query = "select * from users where user_id = '$user_id' limit 1";
$result = mysqli_query($con, $query);
if ($result) {
    if ($result && mysqli_num_rows($result) > 0) {

        $user_data = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $user_data['user_id'];
        $_SESSION['email'] = $user_data['email'];
        $_SESSION['firstName'] = $user_data['firstName'];
        $_SESSION['lastName'] = $user_data['lastName'];
        $_SESSION['balance'] = $user_data['balance'];
    }
}

$query = "SELECT count(*) as total from dailyTransactionData where user_id = '$user_id'";
$result = mysqli_query($con, $query);
if ($result) {

    $days = mysqli_fetch_assoc($result);
    $_SESSION['days'] = $days['total'];
}

$query = "SELECT AVG(eodtotal - sodtotal) as avggainz from dailyTransactionData where user_id = '$user_id'";
$result = mysqli_query($con, $query);
if ($result) {

    $avggainz = mysqli_fetch_assoc($result);
    $_SESSION['avggainz'] = $avggainz['avggainz'];
}

$query = "SELECT SUM(eodtotal - sodtotal) as total from dailyTransactionData where user_id = '$user_id'";
$result = mysqli_query($con, $query);
if ($result) {

    $total = mysqli_fetch_assoc($result);
    $_SESSION['total'] = $total['total'];
}

$query = "SELECT SUM(eodtotal - sodtotal) as total from dailyTransactionData where user_id = '$user_id'";
$result = mysqli_query($con, $query);
if ($result) {

    $total = mysqli_fetch_assoc($result);
    $_SESSION['total'] = $total['total'];
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <?php
    include "header.php";
    ?>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="all">
        <div class="home">
            <h2>Welcome <?php echo $_SESSION['firstName'] ?>!</h2>
            <p>Email: <?php echo $_SESSION['email'] ?></p>
            <p>User ID: <?php echo $_SESSION['user_id'] ?></p>
            <p>Current Balance: $<?php echo $_SESSION['balance'] ?></p>
        </div>
        <div class="home">
            <h2>Account Statistics</h2>
            <p>All time profit: $<?php echo ($_SESSION['total']) ?></p>
            <p>Number of Days Traded: <?php echo $_SESSION['days'] ?></p>
            <p>Average Profit Per Day: $<?php echo $_SESSION['avggainz'] ?></p>
        </div>
    </div>
</body>

</html>