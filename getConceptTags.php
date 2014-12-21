<?php 

  require("dbapi.php");

  $tableName = "concepttags";

  //--------------------------------------------------------------------------
  // Query database for data
  //--------------------------------------------------------------------------
  $result = mysqli_query($con, "SELECT * FROM $tableName");          //query
  $rows = [];
  while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
  }
  echo json_encode($rows);
?>