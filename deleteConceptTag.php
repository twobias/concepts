<?php 

  require("dbapi.php");

  $tableName = "concepttags";
  if (isset($_GET['conceptid']) && $conceptid = $_GET['conceptid']);
  if (isset($_GET['tagid']) && $tagid = $_GET['tagid']);
  
  if ($tagid > 0) {
    $sql = "DELETE FROM $tableName WHERE tagid=$tagid AND conceptid = $conceptid";
    if (mysqli_query($con, $sql)) {
        echo "concepttag slettet.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  } else {
    echo "error id = " . $id;
  }
?>