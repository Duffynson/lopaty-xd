<?php
session_start();
require_once '../../php/db.php';

if(!isset($_SESSION['id_user']) || $_SESSION['role'] != 2) {
    //header("Location: ../auth-error");
    http_response_code(403);
    exit();
} 

/*
Vybere všechny uživatele z databáze
*/
if($stmt = $conn->prepare("UPDATE Rizeni SET ID_redaktor = {$_SESSION['id_user']}, status = 'WAITING_FOR_REVIEWERS' WHERE ID_rizeni = {$_GET['id']}")) {
    $stmt->execute();
    $stmt->close();
    header("Location: ../process?id={$_GET['id']}");
    exit();
}

http_response_code(500);
?>
