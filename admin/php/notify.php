<?php 
require_once '../../php/db.php';
function add_notification($conn, $comment,$subjekt,$ID_user) {
   $notify = "INSERT INTO notifications(subjekt, comment, ID_user) VALUES('{$subjekt}', '{$comment}',{$ID_user})";
   $result = mysqli_query($conn, $notify); 
   echo mysqli_error($conn);
}
?>
