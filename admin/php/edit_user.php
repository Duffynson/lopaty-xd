<?php
session_start();
require_once '../../php/db.php';

if(!isset($_SESSION['id_user']) || ($_SESSION['role'] < 4 && $_SESSION['id_user'] != (int)$_POST['id_user'])) {
    //header("Location: ../auth-error");
    http_response_code(403);
    exit();
}

/*
Kontrola zaslaných údajů

zkontroluje se, zda byly zaslány údaje, zda jsou v požadovaném formátu a rozsahu
pokud ne, vrací se JSON objekt, kde je klíčem třída prvku pro zobrazení chybového hlašení a hodnotou je text chybového hlašení
pokud ano, aktualizují se data v databázi podle zaslaných údajů a vrací se JSON objekt s klíčem "success" a hodnotou "Změny byly uloženy"

V případě chyby databáze se vrací objekt s klíčem "error" a chybová hláška
*/

$results = array();
$_POST['phone'] = str_replace(" ", "", $_POST['phone']);

if(!(isset($_POST["firstname"])) || empty($_POST["firstname"]) || strlen($_POST["firstname"]) > 100 || (preg_match('/[$&+,:;=?@#|<>.^*()%!-]/', $_POST["firstname"]))) $results["firstname-error"] = "Musíte zadat jméno";
if(!(isset($_POST["lastname"])) || empty($_POST["lastname"]) || strlen($_POST["lastname"]) > 100 || (preg_match('/[$&+,:;=?@#|<>.^*()%!-]/', $_POST["lastname"]))) $results["lastname-error"] = "Musíte zadat příjmení";
if(!(isset($_POST["email"])) || empty($_POST["email"]) || strlen($_POST["email"]) > 100 || !(preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $_POST["email"]))) $results["email-error"] = "Musíte zadat email ve správném formátu";
if(!(isset($_POST["role"])) || (int)$_POST["role"] < 0 || (int)$_POST["role"] > 4) $results["role-error"] = "Musíte zadat roli";
if(strlen($_POST['phone']) > 15 || (!preg_match('/^[0-9]{9}$/', $_POST['phone']) && strlen($_POST['phone']) > 0 )) $results["phone-error"] = "Formát: XXX XXX XXX";
if(strlen($_POST["address"]) > 100) $results["address-error"] = "Adresa je moc dlouhá";

if(!empty($results)) {
    exit(json_encode($results));
}

if($stmt = $conn->prepare("UPDATE users SET firstname=?, lastname=?, email=?, role=?, phone=?, address=? WHERE id_user=?")) {
    if($_SESSION['role'] < 4) $role = $_SESSION['role'];
    else $role = (int)$_POST['role'];

    $firstname = htmlspecialchars(strip_tags($_POST["firstname"]));
    $firstname = trim($firstname);
    $lastname = htmlspecialchars(strip_tags($_POST["lastname"]));
    $lastname = trim($lastname);
    $email = htmlspecialchars(strip_tags($_POST["email"]));
    $phone = htmlspecialchars(strip_tags($_POST['phone']));
    if(empty($phone)) $phone = null;
    $address = htmlspecialchars(strip_tags($_POST["address"]));

    $stmt->bind_param("ssssisi", $firstname, $lastname, $email, $role, $phone, $address, $_POST['id_user']);
    
    if($stmt->execute()) {
        exit(json_encode(array("success" => "Změny byly uloženy")));
    }

    $stmt->close();
}

http_response_code(500);
