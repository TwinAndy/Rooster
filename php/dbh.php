<?php

$dbServername = "localhost";
$dbUsername = "id3453645_admin";
$dbPassword = "dbhpass123";
$dbName = "id3453645_rooster";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if(!$conn){
  die("Connection failed: ".mysqli_connect_error());
}
