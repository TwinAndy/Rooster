<?php
if(isset($_POST['login-submit'])){
  require 'dbh.php';

  $mail = $_POST['uid'];
  $password = $_POST['pass'];

  if(empty($mail) || empty($password)){
    header("Location: ../index.php?error=emptyFields&uid=".$mail);
    exit();
  }else{
    $sql = "SELECT * FROM users WHERE emailUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../index.php?error=sqlError");
      exit();
    }else{
      mysqli_stmt_bind_param($stmt, "s", $mail);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($row = mysqli_fetch_assoc($result)){
        $passCheck = password_verify($password, $row['pwdUsers']);
        if($passCheck == false){
          header("Location: ../index.php?error=wrongPass");
          exit();
        }else if($passCheck == true){
          session_start();
          $_SESSION['userId'] = $row['idUsers'];
          $_SESSION['userEmail'] = $row['emailUsers'];
          $_SESSION['userFirst'] = $row['firstUsers'];
          $_SESSION['userLast'] = $row['lastUsers'];

          header("Location: ../dashboard.php?login=succes");
          exit();
        }
      }else{
        header("Location: ../index.php?error=noUser");
        exit();
      }
    }
  }

}else{
  header("Location: ../index.php?error");
  exit();
}
