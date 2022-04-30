<?php
$host    = "127.0.0.1";
$port    = 25003;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $message = $_POST["ww"];
    global $con;
    
    $query = "SELECT messages FROM  messages";
    $result = mysqli_query($con, $query);
    $row = mysqli_num_rows($result);
    while ($row = mysqli_fetch_assoc($result)) {
      print $row["message"]; 
    }
    echo "Message To server :" . $message;
    // create socket
    $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
    // connect to server
    $result = socket_connect($socket, $host, $port) or die("Could not connect to server\n");
    // send string to server
   
    // get server response
    $result = socket_read($socket, 1024) or die("Could not read server response\n");
    echo "Reply From Server  :" . $result;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="ww">
        <input type="submit">

    </form>

</body>

</html>