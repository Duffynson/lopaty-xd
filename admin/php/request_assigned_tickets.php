<?php
session_start();
require_once '../../php/db.php';

if(!isset($_SESSION['id_user'])) {
    //header("Location: ../auth-error");
    http_response_code(403);
    exit();
} 

/*
Vybere všechny přiřazené tickety z databáze
*/
if($stmt = $conn->prepare("SELECT ticket_id, status, title, id_role, date_created, firstname, lastname FROM Tickets JOIN Users ON ID_user = id_creator WHERE id_role = {$_SESSION['role']} ORDER BY date_created DESC")) {
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    exit(json_encode($data));
}
http_response_code(500);
?>
