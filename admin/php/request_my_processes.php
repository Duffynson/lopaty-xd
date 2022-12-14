<?php
session_start();
require_once '../../php/db.php';

if(!isset($_SESSION['id_user'])) {
    //header("Location: ../auth-error");
    http_response_code(403);
    exit();
}

$stmt = '';
if(!isset($_SESSION['id_user'])) exit(json_encode(array()));
else if(isset($_SESSION['id_user']) && $_SESSION['role'] > 2) $stmt = $conn->prepare("SELECT Rizeni.ID_rizeni, Rizeni.datum_vytvoreni, Rizeni.status, Article.title FROM Rizeni JOIN Article ON Rizeni.ID_article = Article.ID_article ORDER BY ID_rizeni ASC");
else $stmt = $conn->prepare("SELECT Rizeni.ID_rizeni, Rizeni.datum_vytvoreni, Rizeni.status, Article.title FROM Rizeni JOIN Article ON Rizeni.ID_article = Article.ID_article WHERE ID_redaktor = {$_SESSION['id_user']} OR recenzent1 = {$_SESSION['id_user']} OR recenzent2 = {$_SESSION['id_user']} OR Article.ID_user = {$_SESSION['id_user']} ORDER BY ID_rizeni ASC");

$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
exit(json_encode($data));

http_response_code(500);
?>
