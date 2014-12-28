<?php 

  require("dbapi.php");

  $name = "";
  if (isset($_GET['name']) && $name = $_GET['name']);
  $id = 0;
  if (isset($_GET['id']) && $id = $_GET['id']);
  $iid = -1;
  if (isset($_GET['uid']) && $uid = $_GET['uid']);
  
  if (($id > 0 ) && ($name != "")) {
    if ($stmt = mysqli_prepare($con, "UPDATE (concepts) SET name=?, updateduserid=?, updated=now() WHERE id=?")) {
      mysqli_stmt_bind_param($stmt, "sii", $name, $uid, $id);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);    
      //update revision
      if ($stmt2 = mysqli_prepare($con, "DELETE FROM revisions WHERE SUBTIME(now(), '00:10:00') < `timestamp` AND conceptid=?")) { //newer than 10 minutes
        mysqli_stmt_bind_param($stmt2, "i", $id);
        mysqli_stmt_execute($stmt2);
        $result2 = mysqli_stmt_get_result($stmt2);    
        if ($stmt3 = mysqli_prepare($con, "INSERT INTO revisions (`userid`, `conceptid`, `timestamp`, `newname`) VALUES (?, ?, now(), ?)")) {
          mysqli_stmt_bind_param($stmt3, "iis", $uid, $id, $name);
          mysqli_stmt_execute($stmt3);
          $result3 = mysqli_stmt_get_result($stmt3);    
        } else {
          echo "Error: " . $result3 . " (revision update)<br>" . mysqli_error($conn); 
        }
      } else {
        echo "Error: " . $result2 . " (delete old revisions)<br>" . mysqli_error($conn); 
      }
    } else {
      echo "Error: " . $result . "<br>" . mysqli_error($conn);
    }
  } else {
    echo "Error - invalid id or name";
  }
?>