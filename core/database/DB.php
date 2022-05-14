<?php
 
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "phptest";


$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_errno()) {

    die("faild to connect " . mysqli_connect_errno());
}
