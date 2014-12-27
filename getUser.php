<?php 

  require("dbapi.php");

  if (isset($_GET['email']) && $email = $_GET['email']);
  if (isset($_GET['name']) && $name = $_GET['name']);

  //--------------------------------------------------------------------------
  // Query database for data
  //--------------------------------------------------------------------------
  $result = mysqli_query($con, "SELECT * FROM `users` WHERE `email` = '$email'");  //query
  
  if (mysqli_num_rows($result) > 0) {
    //if result - update lastlogin timestamp  
    $result2 = mysqli_query($con, "UPDATE `users` SET `lastlogin` = now() WHERE `email` = '$email'");
  } else {
    //if no result - create user (&update firstlogin timestamp)  
    $result2 = mysqli_query($con, "INSERT INTO `users` (`name`, `email`, `canedit`, `firstlogin`, `lastlogin`) VALUES ('$name', '$email', FALSE, now(), now())");
  }
  
  $rows = [];
  while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
  }
  echo json_encode($rows);
?>