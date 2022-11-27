<?php
session_start();
require_once '../../php/db.php';

/*if(!isset($_SESSION['id_user']) || $_SESSION['role'] != 4) {
    //header("Location: ../auth-error");
    http_response_code(403);
    exit();
}*/


/*if($stmt = $conn->prepare("SELECT DISTINCT Article.ID_article, Article.ID_user, Article.title, Article.soubor, Rizeni.ID_rizeni,  FROM Rizeni JOIN Article JOIN Users WHERE ID_rizeni = {$_GET['id']} LIMIT 1")) {
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    exit(json_encode($data));
} */

http_response_code(500);
?>
