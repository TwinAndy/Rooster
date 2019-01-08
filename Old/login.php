<?php

if(session_status()!=PHP_SESSION_ACTIVE) {session_start();}

if (isset($_POST['submit'])){

    include 'dbh.php';

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

    //Error handler
    //Check empty
    if (empty($uid) || empty($pass)){
        header("Location: ../index.php?message=loginempty");
        exit();
    }else {
        $sql = "SELECT * FROM users WHERE user_uid='$uid' OR user_email='$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck < 1){
            header("Location: ../index.php?message=incorrect");
            exit();
        }else {
            if ($row = mysqli_fetch_assoc($result)){
                //De-hashing
                $hashedPassCheck = password_verify($pass, $row['user_pass']);
                if ($hashedPassCheck == false){
                    header("Location: ../index.php?message=incorrect");
                    exit();
                } elseif ($hashedPassCheck == true){
                    //Check email verified
                    if($row['user_verified'] == 0){
                        $_SESSION['email_verify'] = 'no';
                        header("Location: ../index.php");
                        exit();
                    }else{
                        //Log in the user
                    $_SESSION['u_id'] = $row['user_id'];
                    $_SESSION['u_first'] = $row['user_first'];
                    $_SESSION['u_last'] = $row['user_last'];
                    $_SESSION['u_email'] = $row['user_email'];
                    $_SESSION['u_uid'] = $row['user_uid'];
                    header("Location: ../home.php?login=succes");
                    exit();
                    }


                }
            }
        }
    }
} else{
    header("Location: ../index.php");
    exit();
}
