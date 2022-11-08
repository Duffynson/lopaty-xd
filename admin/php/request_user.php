<?php
session_start();
require_once '../../php/db.php';

if(!isset($_SESSION['id_user']) || ($_SESSION['role'] < 4 && $_SESSION['id_user'] != (int)$_GET['id'])) {
    //header("Location: ../auth-error");
    http_response_code(403);
    exit();
} 

if(!isset($_GET['id'])) exit(json_encode(array('error' => 'Nebylo zadáno ID uživatele')));
/*
Vybere databáze z uživatele podle jeho id
Pokud je uživatel administrátor, může upravovat i ostatní uživatele
Pokud není, může upravovat pouze sebe

*/
if($stmt = $conn->prepare("SELECT id_user, firstname, lastname, email, role, phone, address FROM Users WHERE id_user=?")) {
    $id_user = $_GET["id"];
    $stmt->bind_param("i", $id_user);
    if($stmt->execute()) {
        $stmt->bind_result($id_user, $firstname, $lastname, $email, $role, $phone, $address);
        $stmt->fetch();
        $data = array(
            "id_user" => $id_user,
            "firstname" => $firstname,
            "lastname" => $lastname,
            "email" => $email,
            "role" => $role,
            "phone" => $phone,
            "address" => $address
        );
        exit(json_encode($data));
    }
    $stmt->close();
} 

http_response_code(500);

?>