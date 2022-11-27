<?php
session_start();
require_once '../../php/db.php';

if(!isset($_SESSION['id_user']) || $_SESSION['role'] != 4) {
    //header("Location: ../auth-error");
    http_response_code(403);
    exit();
}

if($stmt = $conn->prepare("SELECT Rizeni.ID_rizeni, Rizeni.datum_vytvoreni, Rizeni.status, Article.title FROM Rizeni JOIN Article ON Rizeni.ID_article = Article.ID_article WHERE ID_redaktor IS NULL ORDER BY datum_vytvoreni DESC")) {
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    exit(json_encode($data));
}

http_response_code(500);
?>
