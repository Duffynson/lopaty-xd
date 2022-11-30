<?php 
session_start();
require_once '../../php/db.php';
function add_notification($comment,$subject,$ID_user){

   $notify = "INSERT INTO notifications(subject, comment,ID_user) VALUES('$subject', '$comment','$ID_user'";
   $result = mysqli_query($conn,$notify);
   


}
?>
