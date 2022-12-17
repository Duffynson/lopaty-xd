<?php
session_start();
require_once '../../php/db.php';

if(!isset($_SESSION['id_user'])) {
    //header("Location: ../auth-error");
    http_response_code(403);
    exit();
}

mysqli_query($conn, "UPDATE Tickets SET status = '{$_GET['status']}' WHERE ticket_id = {$_GET['id']}");
?>
