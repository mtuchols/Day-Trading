<?php
session_start();
include("connection.php");
include("functions.php");
$user_data = check_login($con);
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
            <h2>Welcome <?php $user_data['firstName'] ?>!</h2>
            <p>Email: {{ email }}</p>
            <p>Current Balance: {{ email }}</p>
        </div>
        <div class="home">
            <h2>Account Statistics</h2>
            <p>All time profit: {{ atp }}</p>
            <p>Favorite Stock: {{ favistock }}</p>
            <p>Number of Trades Made: {{ numtrades }}</p>
            <p>Average Profit Per Trade: {{ ppt }}</p>
        </div>
    </div>
</body>

</html>