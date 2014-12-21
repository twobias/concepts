<?php 

  require("dbapi.php");

  $tableName = "concepttags";
  $tagid = -1;
  $conceptid = -1;
  if (isset($_GET['tagid']) && $tagid = $_GET['tagid']);
  if (isset($_GET['conceptid']) && $conceptid = $_GET['conceptid']);
  
  
  $sql = "INSERT INTO $tableName (tagid, conceptid)
  VALUES ('$tagid', '$conceptid')";
  
  if (mysqli_query($con, $sql)) {
  } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
?>