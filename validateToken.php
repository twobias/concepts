<?php 

  //checks if a user's cookie token is valid and saves new token if it is

  require("dbapi.php");

  if (isset($_GET['oldtoken']) && $oldtoken = $_GET['oldtoken']);
  
  //--------------------------------------------------------------------------
  // Query database for data
  //--------------------------------------------------------------------------
  if ($stmt = mysqli_prepare($con, "SELECT * FROM tokenhashes WHERE `tokenhash` = ?")) {
    mysqli_stmt_bind_param($stmt, "s", hash('sha256', $oldtoken));
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
  }
  
  $rows = [];
  while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
  }

  $authorized = false;
  if (sizeof($rows) > 0) {
    //if result > 0 ... user found ... delete old token(s)
    if ($stmt = mysqli_prepare($con, "DELETE FROM `tokenhashes` WHERE `tokenhash` = ?")) {
      mysqli_stmt_bind_param($stmt, "s", hash('sha256', $oldtoken));
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
    }
    //and authorize js to save the new user token as cookie
    $authorized = true;
  }

  echo json_encode($authorized);
?>