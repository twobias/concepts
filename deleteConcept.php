<?php 

  require("dbapi.php");

  $tableName = "concepts";
  $id = 0;
  if (isset($_GET['id']) && $id = $_GET['id']);
  $uid = -1;
  if (isset($_GET['uid']) && $uid = $_GET['uid']);
  
  if ($id > 0) {
    $sql = "DELETE FROM $tableName WHERE id=$id";
    if (mysqli_query($con, $sql)) {
        echo "concept med id " . $id . " slettet.";
        //add deletion to revision history (we may want to be able to find out who deleted something later on)
        $sql2 = "INSERT INTO `revisions` (`userid`, `conceptid`, `timestamp`, `newname`, `newdesc`) VALUES ('$uid', '$id', now(), 'DELETED', 'DELETED')";
        mysqli_query($con, $sql2);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  } else {
    echo "error id = " . $id;
  }
?>