<?php

if(session_status()!=PHP_SESSION_ACTIVE) {session_start();}

include "php/dbh.php";

$email = mysqli_real_escape_string($conn, $_GET["email"]);
$code = mysqli_real_escape_string($conn, $_GET["code"]);
$sql = "SELECT * FROM users WHERE user_email='$email'";
$result = mysqli_query($conn, $sql);
$resultcheck = mysqli_num_rows($result);
//Check if email is in db
if($resultcheck < 1){
            header("Location: index.php?message=error");
            exit();
}else{
    if($row = mysqli_fetch_assoc($result)){
        $dbcode = $row["user_code"];
        
        if(empty($email) || empty($code)){
            header("Location: index.php?message=error");
            exit();
        }else{
            if ($dbcode == $code){
                $asql = "UPDATE users SET user_verified='1'";
                $aresult = mysqli_query($conn, $asql);
                $bsql = "UPDATE users SET user_code='0'";
                $bresult = mysqli_query($conn, $bsql);
                
                $_SESSION['email_verify'] = null;
                
                header("Location: index.php?message=verifycomplete");
                exit();
            } else {
                header("Location: index.php?message=error");
                exit();
            }
        }
    }
}