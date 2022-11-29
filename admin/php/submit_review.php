<?php
require_once '../../php/db.php';
$aktualnost = $_POST["aktualnost"];
$originalita = $_POST["originalita"];
$odbornost = $_POST["odbornost"];
$jazyk = $_POST["jazyk"];
$comment = $_POST["textComment"];
$date = date('Y-m-d');
if (!(empty($aktualnost) || empty($originalita) || empty($odbornost) || empty($jazyk) || empty($comment))){
  mysqli_query($conn, "UPDATE Recenze SET aktualnost = '{$aktualnost}', originalita = '{$originalita}', jazyk = '{$jazyk}', odbornost = '{$odbornost}', comment = '{$comment}', datum_recenze = '{$date}' WHERE ID_recenze = '{$_POST["id_review"]}'");
  
  $res = mysqli_query($conn, "SELECT ID_rizeni FROM Rizeni JOIN Recenze WHERE ID_recenze = {$_POST['id_review']}");
  $id_rizeni = mysqli_fetch_assoc($res);

  $result = mysqli_query($conn, "SELECT datum_recenze FROM Recenze WHERE ID_recenze = {$_POST['id_review']}");
  $result2 = mysqli_query($conn, "SELECT datum_recenze FROM Recenze WHERE ID_recenze = {$_POST['id_review']}");
  $data = mysqli_fetch_assoc($result);
  $data2 = mysqli_fetch_assoc($result2);
  if($data['datum_recenze'] != null && $data2['datum_recenze'] != null) mysqli_query($conn, "UPDATE Rizeni SET status = 'REVIEWS_SUBMITTED' WHERE ID_rizeni = {$id_rizeni['ID_rizeni']}");
  
  mysqli_close($conn);
  exit(json_encode(array("success" => "Nahrání recenze proběhlo úspěšně, za okamžik proběhne přesměrování.")));
}
else{
  exit(json_encode(array("error" => "Nebyly vyplněny všechny položky.")));
}
mysqli_close($conn);
http_response_code(500);
?>
