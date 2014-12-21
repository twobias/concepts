<?php 

  require("dbapi.php");

  $tableName = "concepts";
  $name = "";
  if (isset($_GET['name']) && $name = $_GET['name']);
  $id = 0;
  if (isset($_GET['id']) && $id = $_GET['id']);
  
  if (($id >0 ) && ($name != "")) {
    $sql = "UPDATE (concepts) SET name='$name', updated=now() WHERE id=$id";
      echo "Success.. updated " . $id . " name is now: " . $name;
    if (mysqli_query($con, $sql)) {
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  } else {
    echo "Error - invalid id or name";
  }
?>