<?php 

  require("dbapi.php");

  $tableName = "concepts";
  $name = "";
  $uid = -1;
  if (isset($_GET['name']) && $name = $_GET['name']);
  if (isset($_GET['uid']) && $uid = $_GET['uid']);
  
  if ($name == "") {$name = "Nyt Begreb";}

  $sql = "INSERT INTO $tableName (name, description, updateduserid)
  VALUES ('$name', '...', '$uid')";
  
  if (mysqli_query($con, $sql)) {
    //update revision
    $lastid = mysqli_insert_id($con);
    $sql2 = "INSERT INTO `revisions` (`userid`, `conceptid`, `timestamp`, `newname`, `newdesc`) VALUES ('$uid', '$lastid', now(), '$name', '...')";
    mysqli_query($con, $sql2);
  } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
?>