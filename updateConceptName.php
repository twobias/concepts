<?php 

  require("dbapi.php");

  $tableName = "concepts";
  $name = "";
  if (isset($_GET['name']) && $name = $_GET['name']);
  $id = 0;
  if (isset($_GET['id']) && $id = $_GET['id']);
  $iid = -1;
  if (isset($_GET['uid']) && $uid = $_GET['uid']);
  
  if (($id >0 ) && ($name != "")) {
    $sql = "UPDATE (concepts) SET name='$name', updated=now() WHERE id=$id";
      echo "Success.. updated " . $id . " name is now: " . $name;
    if (mysqli_query($con, $sql)) {
      $lastid = mysqli_insert_id($con);
      $sql2 = "INSERT INTO `revisions` (`userid`, `conceptid`, `timestamp`, `newname`) VALUES ('$uid', '$lastid', now(), '$name')";
      mysqli_query($con, $sql2);
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  } else {
    echo "Error - invalid id or name";
  }
?>