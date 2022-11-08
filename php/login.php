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

zkontroluje se, zda byly zaslány údaje, zda jsou v požadovaném formátu
pokud ne, vrací se JSON objekt, kde je klíčem třída prvku pro zobrazení chybového hlašení a hodnotou je text chybového hlašení
pokud ano, zkontroluje se, zda uživatel s tímto emailem existuje
pokud existuje, zkontroluje se, zda heslo odpovídá heslu v databázi
pokud ano, nastaví se data do SESSION proměnné -> uživatel je přihlášen a vrací se JSON objekt s klíčem 'success' a hodnotou true
pokud ne, vrací se JSON objekt s chybovými hláškami

V případě chyby databáze se vrací objekt s klíčem "error" a chybová hláška
*/

$results = array();

if(!(isset($_POST["email"])) || empty($_POST["email"]) || !(preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $_POST["email"]))) $results["email-error"] = "Musíte zadat email ve správném formátu";
if(!(isset($_POST["password"])) || empty($_POST["password"])) $results["password-error"] = "Musíte zadat heslo";
if(!empty($results)) {
    exit(json_encode($results));
}

if ($stmt = $conn->prepare("SELECT * FROM users WHERE email = ?")) {
    $email = htmlspecialchars(strip_tags($_POST["email"]));
    $stmt->bind_param("s", $email);
    if($stmt->execute()) {
        $stmt->bind_result($id_user, $firstname, $lastname, $email, $password, $phone, $address, $role);
        $stmt->fetch();
        if(isset($id_user)) {
            if(password_verify($_POST["password"], $password)) {
                $_SESSION['id_user'] = $id_user;
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $role;
                $stmt->close();
                exit(json_encode(array("success" => "Přihlášení bylo úspešné, probíhá přesměrování")));
            } else {
                $stmt->close();
                exit(json_encode(array("password-error" => "Neplatné heslo")));
            }
        } else {
            $stmt->close();
            exit(json_encode(array("email-error" => "Tento účet neexistuje")));
        }
    }
}

exit(json_encode($results));

http_response_code(500);