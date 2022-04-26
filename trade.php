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
        <label for="ticker">Step 1 - Select a stock: </label>
        <br>
        <input id="tickerText" name="ticker1" placeholder="AAPL" oninput="this.value = this.value.toUpperCase()">
        <br><br>
        <label for="ticker">Step 2 - Select the amount of money you would like the algorithm to use: </label>
        <br>
        <input id="wagerText" name="wager" placeholder="1000">
        <br><br>
        <button onclick=" getStockData(tickerText)">Preview Trade</button>

    </div>
</body>

</html>