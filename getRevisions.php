<?php 

  require("dbapi.php");

  if (isset($_GET['conceptid']) && $conceptid = $_GET['conceptid']);

  //--------------------------------------------------------------------------
  // Query database for data
  //--------------------------------------------------------------------------
  if ($stmt = mysqli_prepare($con, "SELECT * FROM revisions WHERE conceptid = ? ORDER BY `timestamp`")) {
    mysqli_stmt_bind_param($stmt, "i", $conceptid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
  }
  
  $rows = [];
  while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
  }
  echo json_encode($rows);
?>