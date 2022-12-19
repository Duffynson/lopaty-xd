<?php
$DB_HOST = "34.116.235.60";
$DB_USER = "rsp_user";
$DB_PASS = "uOb3jlOI";
$DB_NAME = "rsp";
$con = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
 
 $tables = array();

$result = mysqli_query($con,"SHOW TABLES");
while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}

$return = '';

foreach ($tables as $table) {
    $result = mysqli_query($con, "SELECT * FROM ".$table);
    $num_fields = mysqli_num_fields($result);

    $return .= 'DROP TABLE '.$table.';';
    $row2 = mysqli_fetch_row(mysqli_query($con, 'SHOW CREATE TABLE '.$table));
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
                 ;



date_default_timezone_set('Europe/Prague');
$date = date('Y-m-d-h-i-s', time());
$handle = fopen($date, 'w+');
fwrite($handle, $return);
fclose($handle);
echo "<script>
             alert('Archivace dat proběhla úspěšně!'); 
             window.history.go(-1);
     </script>";

?>
