<?php 

  require("dbapi.php");

  $tableName = "concepts";
  $description = "";
  if (isset($_GET['description']) && $description = $_GET['description']);
  $id = 0;
  if (isset($_GET['id']) && $id = $_GET['id']);
  
  if (($id > 0 ) && ($description != "")) {
    $sql = "UPDATE (concepts) SET description='$description', updated=now() WHERE id=$id";
      echo "Success.. updated " . $id . " description is now: " . $description;
    if (mysqli_query($con, $sql)) {
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  } else {
    echo "Error - invalid id or description";
  }
?>