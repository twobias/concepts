<?php 

  require("dbapi.php");

  $name = "";
  if (isset($_GET['name']) && $name = $_GET['name']);
  
  if ($name == "") {
  } else {
    if ($stmt = mysqli_prepare($con, "INSERT INTO tags (name) VALUES (?)")) {
    $newdesc = "...";
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);    
    } else {
        echo "Error: " . $result . "<br>" . mysqli_error($conn);
    }
  }
?>