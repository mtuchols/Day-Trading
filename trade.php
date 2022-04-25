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
    <div class="trade">
        <h2>Trade</h2>
        <label for="ticker">Step 1: Select a Stock</label>
        <input type="ticker" id="tickerText" name="ticker1" placeholder="AAPL">
        <button v-on:click="hello">Get Info</button>
        <span id="stockinfo"></span>
    </div>
</body>

</html>