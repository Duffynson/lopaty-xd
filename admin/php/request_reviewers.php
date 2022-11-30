<?php
session_start();
require_once '../../php/db.php';

//TODO: Auth check
if(!isset($_SESSION['id_user']) || $_SESSION['role'] < 1) {
    //header("Location: ../auth-error");
    http_response_code(403);
    exit();
} 

if(!isset($_GET['id'])) exit(http_response_code(500));


if($stmt = $conn->prepare("SELECT firstname, lastname, ID_user FROM Users WHERE role = 1")) {
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    exit(json_encode($data));
}

exit(http_response_code(500));
?>