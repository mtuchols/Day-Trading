<?php

$RDS_HOSTNAME= "capstone.cbstb0etcrf8.us-east-1.rds.amazonaws.com";
$RDS_USERNAME = "admin";
$RDS_PASSWORD = "techtrading";
$RDS_DB_NAME = "capstone";
$RDS_PORT = "3306";

if (!$con = mysqli_connect($RDS_HOSTNAME, $RDS_USERNAME, $RDS_PASSWORD, $RDS_DB_NAME, $RDS_PORT))
{
	die("failed to connect!");
}