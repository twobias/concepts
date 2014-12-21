<?php 

  require("dbapi.php");

  $tableName = "concepts";
  $id = 0;
  if (isset($_GET['id']) && $id = $_GET['id']);
  
  if ($id > 0) {
    $sql = "DELETE FROM $tableName WHERE id=$id";
    if (mysqli_query($con, $sql)) {
        echo "concept med id " . $id . " slettet.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  } else {
    echo "error id = " . $id;
  }
?>