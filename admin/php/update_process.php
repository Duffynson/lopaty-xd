<?php
session_start();
require_once '../../php/db.php';

if(!isset($_SESSION['id_user'])) {
    //header("Location: ../auth-error");
    http_response_code(403);
    exit();
}

$date = date('Y-m-d');

mysqli_query($conn, "UPDATE Rizeni SET status = '{$_GET['status']}', datum_ukonceni = '{$date}' WHERE ID_rizeni = {$_GET['ID_rizeni']}");
?>
