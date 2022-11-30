<?php
session_start();
require_once '../../php/db.php';
$aktualnost = $_POST["aktualnost"];
$originalita = $_POST["originalita"];
$odbornost = $_POST["odbornost"];
$jazyk = $_POST["jazyk"];
$comment = $_POST["textComment"];
$date = date('Y-m-d');
if (!(empty($aktualnost) || empty($originalita) || empty($odbornost) || empty($jazyk) || empty($comment))){

  $check = mysqli_query($conn, "SELECT recenzent1, recenzent2 FROM Rizeni WHERE ID_rizeni = {$_POST['ID_rizeni']}");
  $check = mysqli_fetch_assoc($check);
  if($check['recenzent1'] != $_SESSION['id_user'] && $check['recenzent2'] != $_SESSION['id_user']) exit(http_response_code(403));

  mysqli_query($conn, "UPDATE Recenze SET aktualnost = '{$aktualnost}', originalita = '{$originalita}', jazyk = '{$jazyk}', odbornost = '{$odbornost}', comment = '{$comment}', datum_recenze = '{$date}' WHERE ID_recenze = '{$_POST["id_review"]}'");
    
  $res = mysqli_query($conn, "SELECT recenze1, recenze2 FROM Rizeni WHERE ID_rizeni = {$_POST['ID_rizeni']}");
  $res = mysqli_fetch_assoc($res);
  $result = mysqli_query($conn, "SELECT datum_recenze FROM Recenze WHERE ID_recenze = {$res['recenze1']}");
  $result2 = mysqli_query($conn, "SELECT datum_recenze FROM Recenze WHERE ID_recenze = {$res['recenze2']}");
  $data = mysqli_fetch_assoc($result);
  $data2 = mysqli_fetch_assoc($result2);
  echo json_encode($data);
  echo json_encode($data2);
  if($data['datum_recenze'] != NULL && $data2['datum_recenze'] != NULL) mysqli_query($conn, "UPDATE Rizeni SET status = 'REVIEWS_SUBMITTED' WHERE ID_rizeni = {$_POST['ID_rizeni']}");
  
  mysqli_close($conn);
  exit(json_encode(array("success" => "Nahrání recenze proběhlo úspěšně, za okamžik proběhne přesměrování.")));
}
else{
  exit(json_encode(array("error" => "Nebyly vyplněny všechny položky.")));
}
mysqli_close($conn);
http_response_code(500);
?> 
