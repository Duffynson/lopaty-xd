<?php 
include_once '../php/db.php';
if(isset($_GET['id'])){
    $main_id = $_GET['id'];
    $sql_update = mysqli_query($conn, "DELETE FROM notifications WHERE id = {$main_id}");
    if($sql_update){
        header("Location: ./read_msg.php");
    }
    else{
        echo mysqli_error($conn);
    }
}
?>