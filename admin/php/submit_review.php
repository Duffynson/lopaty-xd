<?php
require_once '../../php/db.php';
    if (isset($_POST['submit'])){
      $aktualnost = $_POST["aktualnost"];
      $originalita = $_POST["originalita"];
      $odbornost = $_POST["odbornost"];
      $jazyk = $_POST["jazyk"];
      $comment = $_POST["textComment"];
      $date = date('Y-m-d');
      if (!(empty($aktualnost) || empty($originalita) || empty($odbornost) || empty($jazyk) || empty($comment))){
        mysqli_query($conn, "UPDATE Recenze SET aktualnost = {$aktualnost}, originalita = {$originalita}, jazyk = {$jazyk}, odbornost = {$odbornost}, comment = {$comment}, datum_recenze = {$date} WHERE ID_recenze = $_GET["id"]");
        mysqli_close($conn);
        exit(json_encode(array("success" => "Nahrání recenze proběhlo úspěšně.")));
      }
      else{
        exit(json_encode(array("error" => "Nebyly vyplněny všechny položky.")));
      }
    }
mysqli_close($conn);
http_response_code(500);
?>
