<?php
session_start();
require_once '../../php/db.php';
$title = $_POST["ticket_title"];
$receiver = $_POST["ticket_receiver"];
$text = $_POST["ticket_text"];
$date = date('Y-m-d');

if (!(empty($title) || empty($receiver) || empty($text))){

  mysqli_query($conn, "INSERT INTO Tickets(title, id_creator, id_role, date_created) VALUES ('{$title}', {$_SESSION['id_user']}, '{$receiver}', '{$date}')");
  $ticketID = $conn->insert_id;
  mysqli_query($conn, "INSERT INTO Ticket_responses(ID_ticket, ID_user, R_text, R_date) VALUES ({$ticketID}, {$_SESSION['id_user']}, '{$text}', '{$date}')");

  mysqli_close($conn);
  exit(json_encode(array("success" => "Vytvoření ticketu proběhlo úspěšně, za okamžik proběhne přesměrování.", "ticket_id" => $ticketID)));
}
else{
  exit(json_encode(array("error" => "Nebyly vyplněny všechny položky.")));
}

http_response_code(500);
?> 
