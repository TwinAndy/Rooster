<?php
  if(session_status()!=PHP_SESSION_ACTIVE) {
    session_start();
  }

  if(!isset($_SESSION['u_id'])){
    header("Location: index.php");
  }
?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Dashboard</title>
  </head>
  <body>

  </body>
</html>
