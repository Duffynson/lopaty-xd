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

if($stmt = $conn->prepare("SELECT ID_rizeni, originalita, aktualnost, jazyk, odbornost, comment, recenzent, datum_recenze FROM Recenze JOIN Rizeni ON Rizeni.recenze1 = ID_recenze OR Rizeni.recenze2 = ID_recenze WHERE ID_recenze = {$_GET['id']}")) {
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    exit(json_encode($data));
}

exit(http_response_code(500));
?>