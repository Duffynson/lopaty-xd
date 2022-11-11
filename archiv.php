<?php
include_once './php/db.php'; //Natahne si prihlasovaci udaje.


$sql = "SELECT vydani FROM Journal"; //Vytahne Vsechny cisla casopisu.
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<a href=/archiv/".$row["vydani"].".pdf\">".$row["vydani"]."</a></br>"; //Zobrazi cisla casopisu
    }
} else {
    echo "Archiv je prazdny";
}
$conn->close();



?>
