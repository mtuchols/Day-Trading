<?php
session_start();
include("connection.php");
include("functions.php");
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
            <p>Current Balance: { balance } </p>
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