<?php
session_start();
require_once '../../php/db.php';

if(!isset($_SESSION['id_user'])) {
    //header("Location: ../auth-error");
    http_response_code(403);
    exit();
} 
$data = json_decode(file_get_contents('php://input'), true);

if($stmt = $conn->prepare("UPDATE Rizeni SET status = 'AUTHOR_REQUIRED' WHERE ID_rizeni = {$data['id']}")) {
    $stmt->execute();
    $stmt->close();
    exit(json_encode(array('success' => 'Status byl změněn.')));
}

http_response_code(500);
?>
