<?php 

  require("dbapi.php");

  $id = 0;
  if (isset($_GET['id']) && $id = $_GET['id']);
  $uid = -1;
  if (isset($_GET['uid']) && $uid = $_GET['uid']);
  
  if ($id > 0) {
    /* create a prepared statement */
    if ($stmt = mysqli_prepare($con, "DELETE FROM concepts WHERE id=?")) {
      mysqli_stmt_bind_param($stmt, "i", $id);
      mysqli_stmt_execute($stmt);
      $sql = mysqli_stmt_get_result($stmt);
      echo "concept med id " . $id . " slettet.";
      //add deletion to revision history (we may want to be able to find out who deleted something later on)
      if ($stmt2 = mysqli_prepare($con, "INSERT INTO revisions (`userid`, `conceptid`, `timestamp`, `newname`, `newdesc`) VALUES (?, ?, now(), ?, ?)")) {
        $del = "'DELETED'";
        mysqli_stmt_bind_param($stmt2, "iiss", $uid, $id, $del, $del);
        mysqli_stmt_execute($stmt2);
        $sql2 = mysqli_stmt_get_result($stmt2);
        echo($sql2);
      }
    } else {
      echo "Error: " . $stmt;
    }
  } else {
    echo "error id = " . $id;
  }
?>