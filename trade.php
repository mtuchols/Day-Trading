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
    <div class="home">
        <h1>Trade</h1>
        <h2>Step 1 - Enter a Stock Symbol:</h2>
        <input v-model="message" placeholder="AAPL" />
        <button v-on:click="hello">Get Info</button>
        <span id="stockinfo"></span>
    </div>
</body>

</html>