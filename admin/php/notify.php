<?php 
session_start();
require_once '../../php/db.php';
function add_notification($comment,$subject,$ID_user){

   $notify = "INSERT INTO notifications(subject, comment,ID_user) VALUES('{$subject}', '{$comment}',{$ID_user}";
   echo mysqli_error($conn);
   $result = mysqli_query($conn,$notify);
   }

add_notification('subject', 'bylo zapsáno', 3)
?>
