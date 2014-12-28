<?php 

  require("dbapi.php");

  if (isset($_GET['email']) && $email = $_GET['email']);
  if (isset($_GET['name']) && $name = $_GET['name']);

  //--------------------------------------------------------------------------
  // Query database for data
  //--------------------------------------------------------------------------
  if ($stmt = mysqli_prepare($con, "SELECT * FROM users WHERE `email` = ?")) {
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
  }

  if (mysqli_num_rows($result) > 0) {
    //if result - update lastlogin timestamp  
    if ($stmt2 = mysqli_prepare($con, "UPDATE users SET `lastlogin` = now() WHERE `email` = ?")) {
      mysqli_stmt_bind_param($stmt2, "s", $email);
      mysqli_stmt_execute($stmt2);
      $result2 = mysqli_stmt_get_result($stmt2);
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