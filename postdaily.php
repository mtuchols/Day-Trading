<?php
include("connection.php");

// $ticker = $_COOKIE["ticker"];
// $start = $_COOKIE["start"];
// $startMoney = $_COOKIE["startMoney"];
// $startReference = $_COOKIE["startReference"];
// $algorithm = $_COOKIE["algorithm"];
// $id = 11;

$ticker = "AAPL";
$sodtotal = 0;
$eodtotal = 500;
$algorithm = "coinFlip";
$id = 4237;


// $id = $_SESSION['user_id'];
// $tradeDay = mysql_query("SELECT MAX(tradeDay) FROM dailyTransactionData WHERE user_id = '$_SESSION['user_id']'"); 
// $tradeDay = $tradeDay +1;

$query2 = "insert into dailyTransactionData (user_id, eodtotal, algorithmUsed, sodtotal, tradeDay) values ('$id', '$eodtotal', '$algorithm', '$sodtotal', '1')";
mysqli_query($con, $query2);
