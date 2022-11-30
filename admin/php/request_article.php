<?php
session_start();
require_once '../../php/db.php';

if(!isset($_SESSION['id_user'])) {
    //header("Location: ../auth-error");
    http_response_code(403);
    exit();
}

if(!isset($_GET['id'])) exit(http_response_code(500));

$res = mysqli_query($conn, "SELECT status FROM Rizeni JOIN Article ON Rizeni.ID_article = Article.ID_article WHERE Rizeni.ID_Article = {$_GET['id']}");
$res = mysqli_fetch_assoc($res);
if($res['status'] != 'AUTHOR_REQUIRED') {
    header("Location: ../auth-error");
    exit();
}

if($stmt = $conn->prepare("SELECT soubor2, ID_user FROM Article WHERE ID_article = {$_GET['id']}")) {
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    exit(json_encode($data));
}

exit(http_response_code(500));
?>