<?php 

$db_servername = "34.116.235.60";
$db_username = "rsp_user";
$db_password = "uOb3jlOI";
$db_name = "rsp";

$conn = mysqli_connect($db_servername, $db_username, $db_password, $db_name);
mysqli_set_charset($conn, "utf8");

if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

?>
