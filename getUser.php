<?php 

  //gets information about a user from the database
  //also automatically
  // 1) - stores a hashed version of the users new session token 
  // 2) - updates lastlogin/firstlogin appropriately

  require("dbapi.php");

  if (isset($_GET['email']) && $email = $_GET['email']);
  if (isset($_GET['name']) && $name = $_GET['name']);
  if (isset($_GET['token']) && $token = $_GET['token']);
  
  //--------------------------------------------------------------------------
  // Query database for data
  //--------------------------------------------------------------------------
  if ($stmt = mysqli_prepare($con, "SELECT * FROM users WHERE `email` = ?")) {
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
  }

  if (mysqli_num_rows($result) > 0) {
    //if result - delete old hashed tokens for the user
    if ($stmt2 = mysqli_prepare($con, "DELETE FROM tokenhashes WHERE `email` = ?")) {
      mysqli_stmt_bind_param($stmt2, "s", $email);
      mysqli_stmt_execute($stmt2);
      $result2 = mysqli_stmt_get_result($stmt2);
    }
    //if result - save hashed token for the user
    if ($stmt2 = mysqli_prepare($con, "INSERT INTO tokenhashes (`email`, `tokenhash`) VALUES (?, ?)")) {
      $hashedToken = hash('sha256', $token);
      mysqli_stmt_bind_param($stmt2, "ss", $email, $hashedToken);
      mysqli_stmt_execute($stmt2);
      $result2 = mysqli_stmt_get_result($stmt2);
    }
    //if result - also update lastlogin timestamp  
    if ($stmt2 = mysqli_prepare($con, "UPDATE users SET `lastlogin` = now() WHERE `email` = ?")) {
      mysqli_stmt_bind_param($stmt2, "s", $email);
      mysqli_stmt_execute($stmt2);
      $result2 = mysqli_stmt_get_result($stmt2);
      if ($stmt3 = mysqli_prepare($con, "UPDATE users SET `firstlogin` = now() WHERE `email` = ? AND `firstlogin` IS NULL")) {
	      mysqli_stmt_bind_param($stmt3, "s", $email);
	      mysqli_stmt_execute($stmt3);
	      $result3 = mysqli_stmt_get_result($stmt3);
    	}
    }
  } else {
    //if no result - create user (&update firstlogin timestamp)  
    if ($stmt2 = mysqli_prepare($con, "INSERT INTO users (`name`, `email`, `canedit`, `firstlogin`, `lastlogin`) VALUES (?, ?, ?, now(), now())")) {
      $canEdit = FALSE;
      mysqli_stmt_bind_param($stmt2, "sss", $name, $email, $canEdit);
      mysqli_stmt_execute($stmt2);
      $result2 = mysqli_stmt_get_result($stmt2);
    }
  }
  
  $rows = [];
  while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
  }
  echo json_encode($rows);
?>