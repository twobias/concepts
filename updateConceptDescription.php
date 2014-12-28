<?php 

  require("dbapi.php");

  $description = "";
  if (isset($_GET['description']) && $description = $_GET['description']);
  $id = 0;
  if (isset($_GET['id']) && $id = $_GET['id']);
  $uid = -1;
  if (isset($_GET['uid']) && $uid = $_GET['uid']);
  
  if (($id > 0 ) && ($description != "")) {
    if ($stmt = mysqli_prepare($con, "UPDATE (concepts) SET description=?, updateduserid=?, updated=now() WHERE id=?")) {
      mysqli_stmt_bind_param($stmt, "sii", $description, $uid, $id);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);    
      //update revision
      if ($stmt2 = mysqli_prepare($con, "DELETE FROM revisions WHERE SUBTIME(now(), '00:10:00') < `timestamp` AND conceptid=?")) { //newer than 10 minutes
      	mysqli_stmt_bind_param($stmt2, "i", $id);
	      mysqli_stmt_execute($stmt2);
	      $result2 = mysqli_stmt_get_result($stmt2);    
	      if ($stmt3 = mysqli_prepare($con, "INSERT INTO revisions (`userid`, `conceptid`, `timestamp`, `newdesc`) VALUES (?, ?, now(), ?)")) {
	        mysqli_stmt_bind_param($stmt3, "iis", $uid, $id, $description);
	        mysqli_stmt_execute($stmt3);
	        $result3 = mysqli_stmt_get_result($stmt3);    
	      } else {
	        echo "Error: " . $result3 . " (revision update)<br>" . mysqli_error($con); 
	      }
	    } else {
	    	echo "Error: " . $result2 . " (delete old revisions)<br>" . mysqli_error($con); 
	    }
    } else {
      echo "Error: " . $result . "<br>" . mysqli_error($con);
    }
  } else {
    echo "Error - invalid id or description.";
  }
?>