<?php
session_start();
require_once '../../php/db.php';

//TODO: Auth check
/*if(!isset($_SESSION['id_user']) || $_SESSION['role'] != 4) {
    //header("Location: ../auth-error");
    http_response_code(403);
    exit();
} */

if(!isset($_GET['id'])) exit(http_response_code(500));


if($stmt = $conn->prepare("SELECT r1.datum_recenze as recenze1_datum_recenze, r2.datum_recenze as recenze2_datum_recenze, r1.recenzent as recenze1_recenzent, r2.recenzent as recenze2_recenzent, r1.ID_recenze as recenze1_id, r2.ID_recenze as recenze2_id, a.ID_article as ID_article, a.title as title, u4.firstname as autor_firstname, u4.lastname as autor_lastname, a.datum_vydani as datum_vydani, a.soubor as soubor, a.soubor2 as soubor2, Rizeni.ID_rizeni as ID_rizeni, u5.firstname as editor_firstname, u5.lastname as editor_lastname, Rizeni.status as status, Rizeni.datum_vytvoreni as datum_vytvoreni, Rizeni.datum_ukonceni as datum_ukonceni, u2.firstname as rizeni1_firstname, u2.lastname as rizeni1_lastname, u3.firstname as rizeni2_firstname, u3.lastname as rizeni2_lastname, Rizeni.komentar_sefredaktora as komentar FROM `Rizeni` LEFT JOIN Article a ON a.ID_article = Rizeni.ID_article LEFT JOIN Users u ON u.ID_user = a.ID_user LEFT JOIN Users r ON r.ID_user = Rizeni.ID_redaktor LEFT JOIN Recenze r1 ON r1.ID_recenze = Rizeni.recenze1 LEFT JOIN Recenze r2 ON r2.ID_recenze = Rizeni.recenze2 LEFT JOIN Users u2 ON u2.ID_user = r1.recenzent LEFT JOIN Users u3 ON u3.ID_user = r2.recenzent LEFT JOIN Users u4 ON u4.ID_user = a.ID_user LEFT JOIN Users u5 ON u5.ID_user = r.ID_user WHERE Rizeni.ID_rizeni = {$_GET['id']}")) {
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    exit(json_encode($data));
}

exit(http_response_code(500));
?>