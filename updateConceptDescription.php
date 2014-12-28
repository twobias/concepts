<?php 

  require("dbapi.php");

  $description = "";
  if (isset($_GET['description']) && $description = $_GET['description']);
  $id = 0;
  if (isset($_GET['id']) && $id = $_GET['id']);
  $uid = -1;
  if (isset($_GET['uid']) && $uid = $_GET['uid']);
  
  if (($id > 0 ) && ($description != "")) {
    if ($stmt = mysqli_prepare($con, "UPDATE (concepts) SET description=?, updated=now() WHERE id=?")) {
      mysqli_stmt_bind_param($stmt, "si", $description, $id);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);    
      //update revision
      $lastid = mysqli_insert_id($con);
      if ($stmt2 = mysqli_prepare($con, "INSERT INTO revisions (`userid`, `conceptid`, `timestamp`, `newdesc`) VALUES (?, ?, now(), ?)")) {
        mysqli_stmt_bind_param($stmt2, "iis", $uid, $lastid, $description);
        mysqli_stmt_execute($stmt2);
        $result2 = mysqli_stmt_get_result($stmt2);    
      }
    } else {
      echo "Error: " . $result . "<br>" . mysqli_error($conn);
    }
  } else {
    echo "Error - invalid id or description";
  }
?>