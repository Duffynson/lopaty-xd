<?php
session_start();
require_once '../../php/db.php';
$text = $_POST["ticket_text"];
$ticket_id = $_POST["ticket_id"];
$user = $_SESSION['id_user'];
$date = date('Y-m-d');

if (!(empty($text) || empty($ticket_id))){

    mysqli_query($conn, "INSERT INTO Ticket_responses(ID_ticket, ID_user, R_text, R_date) VALUES ({$ticket_id}, {$user}, '{$text}', '{$date}')");
    mysqli_close($conn);
    exit(json_encode(array("success" => "Nahrání odpovědi proběhlo úspěšně.")));
} else{
    exit(json_encode(array("error" => "Nebyly vyplněny všechny položky.")));
}

http_response_code(500);
?> 
