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

$query = "SELECT * as total from dailyTransactionData where user_id = '$user_id'";
$result = mysqli_query($con, $query);
if ($result) {

    $total = mysqli_fetch_assoc($result);
    $_SESSION['total'] = $total['total'];
}

$dataPoints = array();
//Best practice is to create a separate file for handling connection to database
try {
    $result = mysqli_query($con, "SELECT * FROM dailyTransactionData where user_id = '$user_id' ORDER BY tradeDay");

    foreach ($result as $row) {
        array_push($dataPoints, array("x" => $row['tradeDay'], "y" => $row['eodtotal']));
    }
    $link = null;
} catch (\PDOException $ex) {
    print($ex->getMessage());
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <div class="header stack-top">
        <?php
        include "header.php";
        ?>
    </div>

    
    <link rel="stylesheet" href="styles.css">

    <meta name="viewport" content="width = device-width, initial-scale=.5">
    <meta http-equiv="X-UA_Compatible" content="ie=edge">


    <!-- Import AXIOS for API calls -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                backgroundColor: "#030e12",
                theme: "dark1", // "light1", "light2", "dark1", "dark2"
                title: {
                    // text: "PHP Column Chart from Database"
                },
                data: [{
                    type: "line", //change type to bar, line, area, pie, etc  
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
        }
    </script>

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

    <div class="homechart">
        <h2 style="text-align: center">Balance History</h2>
        <div id="chartContainer" style="margin-left: 36px; margin-right: 36px; margin-top: 36px; height: 380px; border-radius: 15px; margin-bottom: 24px;"></div>
    </div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>

</html>