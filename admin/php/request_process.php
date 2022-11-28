<?php
session_start();
require_once '../../php/db.php';

/*if(!isset($_SESSION['id_user']) || $_SESSION['role'] != 4) {
    //header("Location: ../auth-error");
    http_response_code(403);
    exit();
} */

if(!isset($_GET['id'])) exit(http_response_code(500));


if($stmt = $conn->prepare("SELECT a.ID_article as ID_article, u4.firstname as autor_firstname, u4.lastname as autor_lastname, a.datum_vydani as datum_vydani, a.soubor as soubor, Rizeni.ID_rizeni as ID_rizeni, u5.firstname as editor_firstname, u5.lastname as editor_lastname, Rizeni.status as status, Rizeni.datum_vytvoreni as datum_vytvoreni, Rizeni.datum_ukonceni as datum_ukonceni, u2.firstname as rizeni1_firstname, u2.lastname as rizeni1_lastname, u3.firstname as rizeni2_firstname, u3.lastname as rizeni2_lastname, Rizeni.komentar_sefredaktora as komentar FROM `Rizeni` LEFT JOIN Article a ON a.ID_article = Rizeni.ID_article LEFT JOIN Users u ON u.ID_user = a.ID_user LEFT JOIN Users r ON r.ID_user = Rizeni.ID_redaktor LEFT JOIN Recenze r1 ON r1.ID_recenze = Rizeni.recenze1 LEFT JOIN Recenze r2 ON r2.ID_recenze = Rizeni.recenze2 LEFT JOIN Users u2 ON u2.ID_user = r1.recenzent LEFT JOIN Users u3 ON u3.ID_user = r2.recenzent LEFT JOIN Users u4 ON u4.ID_user = a.ID_user LEFT JOIN Users u5 ON u5.ID_user = r.ID_user WHERE Rizeni.ID_rizeni = {$_GET['id']}")) {
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    exit(json_encode($data));
}

exit(http_response_code(500));
?>

/*SELECT r.ID_article AS ID_article, c.autor AS autor, c.title AS title, c.datum_vydani AS datum_vydani, c.soubor AS soubor, r.ID_rizeni AS ID_rizeni, r.firstname AS firstname, r.lastname AS lastname, r.status AS status, r.datum_vytvoreni AS datum_vytvoreni, r.datum_ukonceni AS datum_ukonceni, r.recenze1 AS recenze1, r.recenze2 AS recenze2, r.komentar AS komentar FROM (SELECT ID_user AS autor, title, datum_vydani, soubor FROM Article WHERE ID_article = (SELECT ID_article FROM Rizeni WHERE ID_rizeni = 2)) AS c, (SELECT ID_article, ID_rizeni, Users.firstname AS firstname, Users.lastname AS lastname, status, datum_vytvoreni, datum_ukonceni, recenze1, recenze2, komentar_sefredaktora AS komentar FROM Rizeni JOIN Users WHERE ID_rizeni = 2) AS r

SELECT r.ID_article AS ID_article, c.autor AS autor, c.title AS title, c.datum_vydani AS datum_vydani, c.soubor AS soubor, r.ID_rizeni AS ID_rizeni, r.firstname AS firstname, r.lastname AS lastname, r.status AS status, r.datum_vytvoreni AS datum_vytvoreni, r.datum_ukonceni AS datum_ukonceni, r.recenze1 AS recenze1, r.recenze2 AS recenze2, r.komentar AS komentar FROM (SELECT ID_user AS autor, title, datum_vydani, soubor FROM Article WHERE ID_article = (SELECT ID_article FROM Rizeni WHERE ID_rizeni = 8)) AS c, (SELECT ID_article, ID_rizeni, Users.firstname AS firstname, Users.lastname AS lastname, status, datum_vytvoreni, datum_ukonceni, recenze1, recenze2, komentar_sefredaktora AS komentar FROM Rizeni JOIN Users WHERE ID_rizeni = 8 AND Rizeni.ID_redaktor = (SELECT ID_redaktor FROM Rizeni WHERE ID_rizeni = 8)) AS r

SELECT * FROM Rizeni JOIN Article a ON a.ID_article = Rizeni.ID_article JOIN Users as u ON u.ID_user = Rizeni.ID_rizeni JOIN Users as r ON r.ID_user = Rizeni.ID_redaktor WHERE Rizeni.ID_rizeni = 2

SELECT Rizeni.ID_rizeni as ID_rizeni, a.ID_article as ID_article, u.ID_user as ID_Autor, r.ID_user as ID_redaktor, r1.ID_recenze as ID_Recenze1 FROM `Rizeni` JOIN Article a ON a.ID_article = Rizeni.ID_article JOIN Users u ON u.ID_user = a.ID_user JOIN Users r ON r.ID_user = Rizeni.ID_redaktor JOIN Recenze r1 ON r1.ID_recenze = Rizeni.recenze1 WHERE Rizeni.ID_rizeni = 8

SELECT Rizeni.ID_rizeni as ID_rizeni, a.ID_article as ID_article, u.ID_user as ID_autor, r.ID_user as ID_redaktor, r1.ID_recenze as ID_recenze1, r2.ID_recenze as ID_recenze2 FROM `Rizeni` JOIN Article a ON a.ID_article = Rizeni.ID_article JOIN Users u ON u.ID_user = a.ID_user JOIN Users r ON r.ID_user = Rizeni.ID_redaktor JOIN Recenze r1 ON r1.ID_recenze = Rizeni.recenze1 JOIN Recenze r2 ON r2.ID_recenze = Rizeni.recenze2 WHERE Rizeni.ID_rizeni = 8

SELECT a.ID_article as ID_article, (SELECT firstname FROM Users WHERE Users.ID_user = a.ID_user) as autor_firstname, (SELECT lastname FROM Users WHERE Users.ID_user = a.ID_user) as autor_lastname, a.datum_vydani as datum_vydani, a.soubor as soubor, Rizeni.ID_rizeni as ID_rizeni, (SELECT firstname FROM Users WHERE Users.ID_user = Rizeni.ID_redaktor) as editor_firstname, (SELECT lastname FROM Users WHERE Users.ID_user = Rizeni.ID_redaktor) as editor_lastname, Rizeni.status as status, Rizeni.datum_vytvoreni as datum_vytvoreni, Rizeni.datum_ukonceni as datum_ukonceni, Rizeni.komentar_sefredaktora as komentar FROM `Rizeni` JOIN Article a ON a.ID_article = Rizeni.ID_article JOIN Users u ON u.ID_user = a.ID_user JOIN Users r ON r.ID_user = Rizeni.ID_redaktor JOIN Recenze r1 ON r1.ID_recenze = Rizeni.recenze1 JOIN Recenze r2 ON r2.ID_recenze = Rizeni.recenze2 WHERE Rizeni.ID_rizeni = 8

SELECT * FROM `Rizeni` JOIN Article a ON a.ID_article = Rizeni.ID_article JOIN Users u ON u.ID_user = a.ID_user JOIN Users r ON r.ID_user = Rizeni.ID_redaktor JOIN Recenze r1 ON r1.ID_recenze = Rizeni.recenze1 JOIN Recenze r2 ON r2.ID_recenze = Rizeni.recenze2 JOIN Users u2 ON u2.ID_user = r1.recenzent JOIN Users u3 ON u3.ID_user = r2.recenzent WHERE Rizeni.ID_rizeni = 8

SELECT a.ID_article as ID_article, u4.firstname as autor_firstname, u4.lastname as autor_lastname, a.datum_vydani as datum_vydani, a.soubor as soubor, Rizeni.ID_rizeni as ID_rizeni, u5.firstname as editor_firstname, u5.lastname as editor_lastname, Rizeni.status as status, Rizeni.datum_vytvoreni as datum_vytvoreni, Rizeni.datum_ukonceni as datum_ukonceni, u2.firstname as rizeni1_firstname, u2.lastname as rizeni1_lastname, u3.firstname as rizeni2_firstname, u3.lastname as rizeni2_lastname, Rizeni.komentar_sefredaktora as komentar FROM `Rizeni` JOIN Article a ON a.ID_article = Rizeni.ID_article JOIN Users u ON u.ID_user = a.ID_user JOIN Users r ON r.ID_user = Rizeni.ID_redaktor JOIN Recenze r1 ON r1.ID_recenze = Rizeni.recenze1 JOIN Recenze r2 ON r2.ID_recenze = Rizeni.recenze2 JOIN Users u2 ON u2.ID_user = r1.recenzent JOIN Users u3 ON u3.ID_user = r2.recenzent JOIN Users u4 ON u4.ID_user = a.ID_user JOIN Users u5 ON u5.ID_user = r.ID_user WHERE Rizeni.ID_rizeni = 8*/