<?php 

  require("dbapi.php");

  $tableName = "tags";
  $id = 0;
  if (isset($_GET['id']) && $id = $_GET['id']);
  
  if ($id > 0) {
    $sql = "DELETE FROM $tableName WHERE id=$id";
    if (mysqli_query($con, $sql)) {
        echo "tag med id " . $id . " slettet.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  } else {
    echo "error id = " . $id;
  }
?>