<?php
  if(session_status()!=PHP_SESSION_ACTIVE) {
    session_start();
  }

  if(!isset($_SESSION['userId'])){
    header("Location: index.php");
  }
?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Dashboard</title>
  </head>
  <body>
    hoi
    <form action="php/logout.php" method="POST">
      <button type="submit" name="logout-submit">Log out</button>
    </form>
  </body>
</html>
