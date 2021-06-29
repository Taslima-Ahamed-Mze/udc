<?php
// Config Base

$hostname = "localhost";
$username = "XXXXXX";
$password ="XXXXXXX";
$dbname = "XXXXXXXXX";

$link = mysqli_connect($hostname, $username, $password,$dbname) or die("Impossible de se connecter avec la base.");


mysqli_query($link,"SET NAMES UTF8");
?>