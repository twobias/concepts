<?php 

  require("dbapi.php");

  $name = "";
  $uid = -1;
  if (isset($_GET['name']) && $name = $_GET['name']);
  if (isset($_GET['uid']) && $uid = $_GET['uid']);
  
  if ($name == "") {$name = "Nyt Begreb";}
  
  if ($stmt = mysqli_prepare($con, "INSERT INTO concepts (name, description, updateduserid) VALUES (?, ?, ?)")) {
    $newdesc = "...";
    mysqli_stmt_bind_param($stmt, "ssi", $name, $newdesc, $uid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);    
    //update revision
    $lastid = mysqli_insert_id($con);

    if ($stmt2 = mysqli_prepare($con, "INSERT INTO `revisions` (`userid`, `conceptid`, `timestamp`, `newname`, `newdesc`) VALUES (?, ?, now(), ?, ?)")) {
      mysqli_stmt_bind_param($stmt2, "iiss", $uid, $lastid, $name, $newdesc);
      mysqli_stmt_execute($stmt2);
      $result2 = mysqli_stmt_get_result($stmt2);    
    }

  } else {
      echo "Error: " . $result . "<br>" . mysqli_error($conn);
  }
?>