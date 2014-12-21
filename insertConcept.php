<?php 

  require("dbapi.php");

  $tableName = "concepts";
  $name = "";
  if (isset($_GET['name']) && $name = $_GET['name']);
  
  if ($name == "") {$name = "Nyt Begreb";}

  $sql = "INSERT INTO $tableName (name, description)
  VALUES ('$name', '...')";
  
  if (mysqli_query($con, $sql)) {
  } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
?>