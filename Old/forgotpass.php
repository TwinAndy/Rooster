<?php

if(session_status()!=PHP_SESSION_ACTIVE) {session_start();}

if (isset($_POST['submit'])){
    
    include 'dbh.php';
    
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    //Check field empty
    if (empty($uid)){
        header("Location: ../index.php?message=loginempty");
        exit();
    }else{
        $sql = "SELECT * FROM users WHERE user_email='$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        
        //Check email in db
        if($resultCheck < 1){
            header("Location: ../index.php?message=incorrectmail");
            exit();
        }else{
            //Check if code in db
            $row = mysqli_fetch_assoc($result);
            //mysqli can only give strings = error
            //https://stackoverflow.com/questions/5323146/mysql-integer-field-is-returned-as-string-in-php
            $code = $row(['user_resetcode']);
            echo $code;
            if($code = 1){
                header("Location: ../index.php?message=code1");
                exit();
            }else{
                //Generate code
                $code = md5($uid.time());
                
                //Import code in db
                $sql = "INSERT INTO users (user_resetcode) VALUES ('$code');";
                mysqli_query($conn, $sql);
                
                //Send mail
                
                //Exit
                header("Location: ../index.php?message=mailsend");
                exit();
            }
        }
        
    }
}
//check email
    //add code to user in db
        //send mail
            //destroy code in 24 hours