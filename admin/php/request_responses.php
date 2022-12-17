<?php
session_start();
require_once '../../php/db.php';

if(!isset($_SESSION['id_user'])) {
    header("Location: ../auth-error");
    exit();
}

if(!isset($_GET['id'])) exit(http_response_code(500));

if($stmt = $conn->prepare("SELECT R_text, R_date, firstname, lastname, Users.role, Tickets.status, Tickets.ID_creator as creator, Tickets.ID_role as role FROM Ticket_responses JOIN Users ON Ticket_responses.ID_user = Users.ID_user JOIN Tickets ON Tickets.ticket_id = Ticket_responses.ID_ticket WHERE Ticket_responses.ID_ticket = {$_GET['id']} ORDER BY ID_response DESC")) {
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    exit(json_encode($data));
} 

exit(http_response_code(500));
?>