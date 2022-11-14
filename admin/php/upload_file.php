<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>

<?php
   require_once '../../php/db.php';

   if(isset($_FILES['soubor'])){
      $file_name = $_FILES['soubor']['name'];
      $file_tmp = $_FILES['soubor']['tmp_name'];
      $tmp = explode('.',$file_name);
      $file_ext = strtolower(end($tmp));
      $extensions= array("pdf","doc","docx");

      if(in_array($file_ext,$extensions)=== false){
         echo "Článek musí být ve formátech pdf, docx nebo doc.";
      }      

      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"../../clanky/".$file_name); //Uploadne soubor na server
         echo "Success";
         $date = date('Y-m-d');
         mysqli_query("INSERT INTO Article (title, datum_vydani, soubor, ID_user) values('$_POST[articleName]','$date', '$file_name', '$_SESSION['id_user']')"); //Udela novy zaznam do databaze
      }else{
         echo "Něco se nepodařilo";
      }
   }
   mysqli_close($conn);
?>
<html>
   <body>
      <form action="" method="POST" enctype="multipart/form-data">
         <label>Zadejte název článku: (Pro nahrani dalsi verze pouzijte originalni nazev + _new)</label>
         <input type="text" name="articleName"/><br>
         <input type="file" name="soubor"/>
         <input type="submit"/>				
      </form>      
   </body>
</html>

