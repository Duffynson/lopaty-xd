<?php 
require_once '../../php/db.php';
function add_notification($conn, $comment,$subject,$ID_user) {
   $notify = "INSERT INTO notifications(subkejt, comment, ID_user) VALUES({$subject}, {$comment},{$ID_user}";
   $result = mysqli_query($conn, $notify); 
   echo mysqli_error($conn);
}

add_notification($conn, 'subject', 'bylo zapsáno', 3);
?>
