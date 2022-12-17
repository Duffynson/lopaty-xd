<?php
session_start();
require_once '../../php/db.php';

if(!isset($_SESSION['id_user'])) {
    //header("Location: ../auth-error");
    http_response_code(403);
    exit();
}

mysqli_query($conn, "UPDATE Recenze SET status = '{$_GET['status']}' WHERE ID_recenze = {$_GET['id']}");
$res = mysqli_query($conn, "SELECT recenze1, recenze2 FROM Rizeni WHERE ID_rizeni = {$_GET['ID_rizeni']}");
$res = mysqli_fetch_assoc($res);
$result = mysqli_query($conn, "SELECT status FROM Recenze WHERE ID_recenze = {$res['recenze1']}");
$result2 = mysqli_query($conn, "SELECT status FROM Recenze WHERE ID_recenze = {$res['recenze2']}");
$data = mysqli_fetch_assoc($result);
$data2 = mysqli_fetch_assoc($result2);
if($data['status'] != "CREATED" && $data2['status'] != "CREATED") mysqli_query($conn, "UPDATE Rizeni SET status = 'REVIEWS_REVIEWED' WHERE ID_rizeni = {$_GET['ID_rizeni']}");

?>
