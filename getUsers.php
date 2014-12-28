<?php 

  require("dbapi.php");

  //--------------------------------------------------------------------------
  // Query database for data
  //--------------------------------------------------------------------------
  if ($stmt = mysqli_prepare($con, "SELECT * FROM users")) {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
  }
  
  $rows = [];
  while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
  }
  echo json_encode($rows);
?>