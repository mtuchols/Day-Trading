<?php
include("connection.php");


$ticker = $_COOKIE["ticker"];
$start = $_COOKIE["start"];
$startMoney = $_COOKIE["startMoney"];
$startReference = $_COOKIE["startReference"];
$algorithm = $_COOKIE["algorithm"];
$id = 4237;

// $id = $_SESSION['user_id'];
// $tradeDay = mysql_query("SELECT MAX(tradeDay) FROM dailyTransactionData WHERE  $id = '$_SESSION['user_id']'"); 
// $tradeDay = $tradeDay +1;

$query2 = "insert into dailyTransactionData (user_id, eodtotal, algorithmUsed, sodtotal, tradeDay) values ('$id', '$startMoney', '$algorithm', '$startReference', '1')";
mysqli_query($con, $query2);

?>

