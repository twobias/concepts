<?php 

  require("dbapi.php");

  $id = 0;
  if (isset($_GET['id']) && $id = $_GET['id']);
  
  if ($id > 0) {
    /* create a prepared statement */
    if ($stmt = mysqli_prepare($con, "DELETE FROM tags WHERE id=?")) {
      mysqli_stmt_bind_param($stmt, "i", $id);
      mysqli_stmt_execute($stmt);
      $sql = mysqli_stmt_get_result($stmt);
      echo "tag med id " . $id . " slettet.";
    } else {
      echo "Error: " . $stmt;
    }
  } else {
    echo "error id = " . $id;
  }
?>