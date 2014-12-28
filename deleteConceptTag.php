<?php 

  require("dbapi.php");

  if (isset($_GET['conceptid']) && $conceptid = $_GET['conceptid']);
  if (isset($_GET['tagid']) && $tagid = $_GET['tagid']);
  
  if ($tagid > 0) {
    /* create a prepared statement */
    if ($stmt = mysqli_prepare($con, "DELETE FROM concepttag WHERE tagid=? AND conceptid = ?")) {
      mysqli_stmt_bind_param($stmt, "ii", $tagid, $conceptid);
      mysqli_stmt_execute($stmt);
      $sql = mysqli_stmt_get_result($stmt);
    } else {
      echo "Error: " . $stmt;
    }
  } else {
    echo "error id = " . $id;
  }
?>