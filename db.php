<?php
$servername = "localhost";
$username   = "root";
$password   = "cvtc";
$dbname     = "teknotower";

$db = mysqli_connect($servername, $username, $password, $dbname);

if (!$db)
{
  die("Hata oluştu: " . mysqli_connect_error());
}

?>
