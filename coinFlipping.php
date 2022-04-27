<?php
session_start();
include("connection.php");
include("functions.php");

$ticker = $_COOKIE["ticker"];
$start = $_COOKIE["start"];
$startMoney = $_COOKIE["startMoney"];
$startReference = $_COOKIE["startReference"];
$algorithm = $_COOKIE["algorithm"];

$tradeDay = mysql_query("SELECT MAX(tradeDay) FROM dailyTransactionData WHERE user_id = '$_SESSION['user_id']'"); 
$tradeDay = $tradeDay +1;

$query2 = "insert into dailyTransactionData (user_id, eodtotal, algorithmUsed, sodtotal, tradeDay) values ('$firstName', '$startMoney', '$algorithm', '$startReference', '$tradeDay')";
mysqli_query($con, $query2);

?>

