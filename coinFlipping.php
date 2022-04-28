<?php
include("connection.php");


$ticker = $_COOKIE["ticker"];
$start = $_COOKIE["start"];
$startMoney = $_COOKIE["startMoney"];
$startReference = $_COOKIE["startReference"];
$algorithm = $_COOKIE["algorithm"];

$id = 4237;
// $id = $_SESSION['user_id'];
// $tradeDay = mysql_query($con, "SELECT MAX(tradeDay) FROM dailyTransactionData WHERE  $id = 1001"); 
// $tradeDay = $tradeDay +1;

$query2 = "insert into dailyTransactionData (user_id, eodtotal, algorithmUsed, sodtotal,  stock) values ('$id', '$startMoney', '$algorithm', '$startReference', '$ticker')";

$result = mysqli_query($con, $query2);

if ( false===$result ) {
    printf("error: %s\n", mysqli_error($con));
  }
  else {
    echo 'done.';
  }

?>

