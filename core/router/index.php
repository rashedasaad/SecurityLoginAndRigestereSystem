<?php
require "../funcs/functions.php";
$check = new check;
$check->check_login("user","http://localhost/SecurityLoginAndRigestereSystem/core/router/login.php");
echo "welcome";