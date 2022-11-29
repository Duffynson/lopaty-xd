<?php
   session_start();
   require_once '../../php/db.php';

   if(!isset($_POST['articleName']) || empty($_POST['articleName'])) 
      exit(json_encode(array("error" => "Musíte zadat název článku.")));

   if(isset($_FILES['soubor'])){
      $file_name = $_FILES['soubor']['name'];
      $file_tmp = $_FILES['soubor']['tmp_name'];
      $tmp = explode('.',$file_name);
      $file_ext = strtolower(end($tmp));
      $extensions= array("pdf","doc","docx");

      if(in_array($file_ext,$extensions)=== true) {
         $date = date('Y-m-d');
         mysqli_query($conn, "INSERT INTO Article (title, soubor, ID_user) values('{$_POST['articleName']}', '{$file_name}', {$_SESSION['id_user']})"); //Udela novy zaznam do databaze
         $article_id = $conn->insert_id;
         $file_name = "{$article_id}-{$date}-1.{$file_ext}";
         move_uploaded_file($file_tmp,"../../clanky/" . $file_name); //Uploadne soubor na server
         mysqli_query($conn, "INSERT INTO Rizeni (datum_vytvoreni, ID_article) values('{$date}', $conn->insert_id)");
         mysqli_query($conn, "UPDATE Article SET soubor = '{$file_name}' WHERE ID_article = {$article_id}");
         mysqli_close($conn);
         exit(json_encode(array("success" => "Nahrání článku proběhlo úspěšně a bylo zahájeno řízení.")));
         //echo "Nahrání proběhlo úspěšně.";
      }else{
         //echo "Článek musí být ve formátech pdf, docx nebo doc.";
         exit(json_encode(array("error" => "Článek musí být ve formátech pdf, docx nebo doc.")));
      }
   }
   mysqli_close($conn);
   http_response_code(500);
?>

