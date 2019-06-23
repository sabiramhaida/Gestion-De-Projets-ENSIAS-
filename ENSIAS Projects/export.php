<?php  
session_start();
include("connect_database.php");
if(isset($_POST["Exporter"])){
$filename = "Soutenance.xls";       
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");
$query="select * from soutenance where id_soutenance";
$result=  mysqli_query($connect,$query);
ExportFile($result);
}

function ExportFile($records) {
    $heading = false;
    if(!empty($records))
      foreach($records as $row) {
        if(!$heading) {
          // display field/column names as a first row
          echo implode("\t", array_keys($row)) . "\n";
          $heading = true;
        }
        echo implode("\t", array_values($row)) . "\n";
      }
    exit;
}
?>