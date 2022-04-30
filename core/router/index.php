<?php
require "../funcs/functions.php";
$check = new check;
$check->check_login("user","http://localhost/SecurityLoginAndRigestereSystem/core/router/login.php");
echo "welcome";


$a = ["b","2","a","1","3","s","4","g","5"];

sort($a);


for ($i=0; $i < count($a); $i++) { 
    print $a[$i];
}