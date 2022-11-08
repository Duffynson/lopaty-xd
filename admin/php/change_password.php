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
pokud ano, aktualizují se data v databázi podle zaslaných údajů
Pokud jsou data stejná a nezměnily se, vrací se JSON objekt s klíčem 'error' a hodnotou "Nebyly provedeny žádné změny"
Pokud se data změní, vrací se JSON objekt s klíčem "success" a hodnotou "Změny byly uloženy"

V případě chyby databáze se vrací objekt s klíčem "error" a chybová hláška
*/

$results = array();
if(!(isset($_POST["password"])) || empty($_POST["password"]) || strlen($_POST["password"]) < 8 || strlen($_POST["password"]) > 100) $results["password-error"] = "Musíte zadat heslo o délce alespoň 8 znaků";
if(!(isset($_POST["password_again"])) || empty($_POST["password_again"]) || (isset($_POST["password"]) && !empty($_POST["password"]) && $_POST["password"] != $_POST["password_again"]) || strlen($_POST["password_again"]) > 100) $results["password_again-error"] = "Hesla se neshodují";

if(!empty($results)) {
    exit(json_encode($results));
}

if($stmt = $conn->prepare("UPDATE Users SET password = ? WHERE id_user = ?")) {
    $password = htmlspecialchars(strip_tags($_POST["password"]));
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bind_param("si", $password_hashed, $_POST["id_user"]);
    
    if($stmt->execute()) {
        $results["success"] = "Heslo bylo úspěšně změněno";
        exit(json_encode($results));
    }
    
    $stmt->close();
}

http_response_code(500);


