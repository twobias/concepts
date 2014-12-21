<?php 

  require("dbapi.php");

  $tableName = "tags";
  $name = "";
  if (isset($_GET['name']) && $name = $_GET['name']);
  
  if ($name == "") {
  } else {
    $sql = "INSERT INTO $tableName (name)
    VALUES ('$name')";
    
    if (mysqli_query($con, $sql)) {
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
?>