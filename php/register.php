<?php
session_start();

// Pokud je uživatel už přihlášený, přesměruj ho na index.php
if(isset($_SESSION['id_user'])) {
    header('Location: ../index.php');
    exit();
}

require_once './db.php';

/*
Kontrola zaslaných údajů

zkontroluje se, zda byly zaslány údaje, zda jsou v požadovaném formátu a  rozsahu
pokud ne, vrací se JSON objekt, kde je klíčem třída prvku pro zobrazení chybového hlašení a hodnotou je text chybového hlašení
pokud ano, zkontroluje se, zda uživatel s tímto emailem již neexistuje
pokud existuje, vrací se JSON objekt s klíčem "email-error" a hodnotou "Účet s tímto emailem už existuje"
pokud neexistuje, vytvoří se nový uživatel, nastaví se data do SESSION proměnné -> uživatel je přihlášen a vrací se JSON objekt s klíčem "success" a hodnotou "true"

V případě chyby databáze se vrací objekt s klíčem "error" a chybová hláška
*/

$results = array();
if(!(isset($_POST["firstname"])) || empty($_POST["firstname"]) || strlen($_POST["firstname"]) > 100 || (preg_match('/[$&+,:;=?@#|<>.^*()%!-]/', $_POST["firstname"]))) $results["firstname-error"] = "Musíte zadat jméno";
if(!(isset($_POST["lastname"])) || empty($_POST["lastname"]) || strlen($_POST["lastname"]) > 100 || (preg_match('/[$&+,:;=?@#|<>.^*()%!-]/', $_POST["lastname"]))) $results["lastname-error"] = "Musíte zadat příjmení";
if(!(isset($_POST["email"])) || empty($_POST["email"]) || !(preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $_POST["email"])) || strlen($_POST["email"]) > 100) $results["email-error"] = "Musíte zadat email ve správném formátu";
if(!(isset($_POST["password"])) || empty($_POST["password"]) || strlen($_POST["password"]) < 8 || strlen($_POST["password"]) > 100) $results["password-error"] = "Musíte zadat heslo o délce alespoň 8 znaků";
if(!(isset($_POST["password_again"])) || empty($_POST["password_again"]) || (isset($_POST["password"]) && !empty($_POST["password"]) && $_POST["password"] != $_POST["password_again"]) || strlen($_POST["password_again"]) > 100) $results["password_again-error"] = "Hesla se neshodují";

if(!empty($results)) {
    exit(json_encode($results));
}

if ($stmt = $conn->prepare("INSERT INTO Users (firstname, lastname, email, password) VALUES (?, ?, ?, ?)")) {
    $firstname = htmlspecialchars(strip_tags($_POST["firstname"]));
    $firstname = trim($firstname);
    $lastname = htmlspecialchars(strip_tags($_POST["lastname"]));
    $lastname = trim($lastname);
    $email = htmlspecialchars(strip_tags($_POST["email"]));
    $password = htmlspecialchars(strip_tags($_POST["password"]));

    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    $stmt->bind_param('ssss', $firstname, $lastname, $email,  $password_hashed);
    
    if($stmt->execute()) {
        $_SESSION['id_user'] = $conn->insert_id;
        $_SESSION['firstname'] = $_POST["firstname"];
        $_SESSION['lastname'] = $_POST['lastname'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['role'] = 0;

        //Muzu vracet ID($conn->insert_id) v pripade, ze bych chtel pres JS presmerovat na profil novyho uzivatele
        $stmt->close();
        exit(json_encode(array("success" => "Registrace byla úspešná, probíhá přesměrování")));
    } else {
        $stmt->close();
        exit(json_encode(array("email-error" => "Účet s tímto emailem už existuje")));
    }
} 

http_response_code(500);