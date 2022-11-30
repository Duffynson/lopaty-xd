<?php
   session_start();
   require_once '../../php/db.php';

   if(!(isset($_SESSION['id_user'])) || $_SESSION['role'] != 0) exit(http_response_code(403));

   if(isset($_FILES['soubor'])){
      $file_name = $_FILES['soubor']['name'];
      $file_tmp = $_FILES['soubor']['tmp_name'];
      $tmp = explode('.',$file_name);
      $file_ext = strtolower(end($tmp));
      $extensions= array("pdf","doc","docx");
 
      if(in_array($file_ext,$extensions) === true) {
         $date = date('Y-m-d');
         $article_id = $_POST['article_id'];
         $file_name = "{$article_id}-{$date}-2.{$file_ext}";
         move_uploaded_file($file_tmp,"../../clanky/" . $file_name); //Uploadne soubor na server
         mysqli_query($conn, "UPDATE Article SET soubor2 = '{$file_name}' WHERE ID_article = {$article_id}");
         $result = mysqli_query($conn, "SELECT ID_rizeni FROM Rizeni WHERE ID_article = {$article_id}");
         $result = mysqli_fetch_assoc($result);
         mysqli_query($conn, "UPDATE Rizeni SET status = 'REVIEWERS_REQUIRED' WHERE ID_rizeni = {$result['ID_rizeni']}");
         mysqli_close($conn);
         exit(json_encode(array("success" => "Aktualizace článku proběhla úspěšně, proběhne přesměrování.", "id_article" => $result['ID_rizeni'])));
      }else{
         exit(json_encode(array("error" => "Článek musí být ve formátech pdf, docx nebo doc.")));
      }
}
   mysqli_close($conn);
   http_response_code(500);
?>

