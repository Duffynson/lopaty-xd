<?php
require_once '../../php/db.php';
require_once './notify.php;

$joj = '';
$recenze = '';
if(isset($_POST["recenzent1"])) {
    $joj = 'recenzent1';
    $recenze = 'recenze1';
} else {
    $joj = 'recenzent2';
    $recenze = 'recenze2';
}

$recenzent = $_POST[$joj];

$date = date('Y-m-d');
mysqli_query($conn, "INSERT INTO Recenze(recenzent, datum_vytvoreni) VALUES ({$recenzent}, '{$date}')");
mysqli_query($conn, "UPDATE Rizeni SET {$joj} = {$recenzent}, {$recenze} = {$conn->insert_id} WHERE ID_rizeni = {$_POST['id']}");

$result = mysqli_query($conn, "SELECT recenze1, recenze2 FROM Rizeni WHERE ID_rizeni = {$_POST['id']}");
$data = mysqli_fetch_assoc($result);
if($data['recenze1'] != null && $data['recenze2'] != null) mysqli_query($conn, "UPDATE Rizeni SET status = 'WAITING_FOR_REVIEWS' WHERE ID_rizeni = {$_POST['id']}");
add_notification('subject','Bylo zapsáno', 3);
mysqli_close($conn);
exit(json_encode(array("success" => "Nahrání recenze proběhlo úspěšně.")));
?>
