<?php
session_start();
require_once '../../php/db.php';

if(!isset($_SESSION['id_user']) || $_SESSION['role'] != 4) {
    //header("Location: ../auth-error");
    http_response_code(403);
    exit();
} 

/*
Vybere všechny uživatele z databáze
*/
if($stmt = $conn->prepare("SELECT * FROM Users ORDER BY id_user ASC")) {
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    exit(json_encode($data));
}

http_response_code(500);
?>
