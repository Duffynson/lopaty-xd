<?php

session_start();
require_once '../../php/db.php';

$tables = array();

$result = mysqli_query($conn,"SHOW TABLES");
while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}

$return = '';

foreach ($tables as $table) {
    $result = mysqli_query($conn, "SELECT * FROM ".$table);
    $num_fields = mysqli_num_fields($result);

    $return .= 'DROP TABLE '.$table.';';
    $row2 = mysqli_fetch_row(mysqli_query($conn, 'SHOW CREATE TABLE '.$table));
    $return .= "\n\n".$row2[1].";\n\n";

    for ($i=0; $i < $num_fields; $i++) { 
        while ($row = mysqli_fetch_row($result)) {
            $return .= 'INSERT INTO '.$table.' VALUES(';
            for ($j=0; $j < $num_fields; $j++) { 
                $row[$j] = addslashes($row[$j]);
                if (isset($row[$j])) {
                    $return .= '"'.$row[$j].'"';} else { $return .= '""';}
                    if($j<$num_fields-1){ $return .= ','; }
                }
                $return .= ");\n";
            }
        }
        $return .= "\n\n\n";
    
}

date_default_timezone_set('Europe/Prague');
$date = date('Y-m-d-H-i-s', time());
$handle = fopen("../backup/{$date}.sql", 'w+');
fwrite($handle, $return);
fclose($handle);
header("content-disposition: attachment; filename={$date}.sql");
readfile("../backup/{$date}.sql");

echo "<script> window.history.go(-1); </script>";

?>
