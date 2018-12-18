<?php
if(isset($_POST['register-submit'])){
    require 'dbh.php';

    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $mail = mysqli_real_escape_string($conn, $_POST['mail']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

    if(empty($first) || empty($last) || empty($mail) || empty($pass)){
      header("Location: ../register.php?error=emptyfields&first=".$first."&last=".$last."&mail=".$mail);
      exit();
    }else if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
      header("Location: ../register.php?error=invalidmail&first=".$first."&last=".$last);
      exit();
    }else if(!preg_match("/^[a-zA-Z0-9]*$/", $first || !preg_match("/^[a-zA-Z0-9]*$/", $last))){
      header("Location: ../register.php?error=invalid_char&mail=".$mail);
      exit();
    }else{
      $sql = "SELECT * FROM users WHERE emailUsers=?";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../register.php?error=sqlerror&mail=".$mail);
        exit();
      }else{
        mysqli_stmt_bind_param($stmt, "s", $mail);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if($resultCheck > 0){
          header("Location: ../register.php?error=mail_taken&first=".$first."&last=".$last);
          exit();
        }else{
          $sql = "INSERT INTO users (firstUsers, lastUsers, emailUsers, pwdUsers, verifyUsers) VALUES (?, ?, ?, ?, ?);";
          $stmt = mysqli_stmt_init($conn);
          if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../register.php?error=sqlerror");
            exit();
          }else{
            $hashedpass = password_hash($pass, PASSWORD_DEFAULT);
            $code = md5($mail.time());
            mysqli_stmt_bind_param($stmt, "sssss", $first, $last, $mail, $hashedpass, $code);
            mysqli_stmt_execute($stmt);
            header("Location: ../register.php?signup=succes");
            exit();

          }
        }
      }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}else{
  header("Location: ../register.php");
  exit();
}
