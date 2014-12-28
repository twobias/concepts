<?php 

  require("dbapi.php");

  $tagid = -1;
  $conceptid = -1;
  if (isset($_GET['tagid']) && $tagid = $_GET['tagid']);
  if (isset($_GET['conceptid']) && $conceptid = $_GET['conceptid']);
    
  if ($stmt = mysqli_prepare($con, "INSERT INTO concepttags (tagid, conceptid) VALUES (?, ?)")) {
    $newdesc = "...";
    mysqli_stmt_bind_param($stmt, "ii", $tagid, $conceptid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);    
  } else {
      echo "Error: " . $result . "<br>" . mysqli_error($conn);
  }
?>