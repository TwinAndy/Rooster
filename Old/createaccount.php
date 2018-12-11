<?php

if(isset($_POST['submit'])){
    
    include_once 'dbh.php';
    
    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
    $cpass = mysqli_real_escape_string($conn, $_POST['cpass']);
    
    //pass small and number
    //admin
    
    //Error handlers
    //Check empty fields
    
    if (empty($first) || empty($last) || empty($email) || empty($uid) || empty($pass) || empty($cpass)){
        header("Location: ../accountcreation.php?signup=empty");
        exit();
    }else{
        //Check passwords equal
        if($cpass != $pass){
            header("Location: ../accountcreation.php?passwords=dontmatch");
            exit();
        }else{
            //Check input characters = valid
            if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
                header("Location: ../accountcreation.php?signup=invalid_char");
                exit();
            }else{
                //Check valid email
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    header("Location: ../accountcreation.php?signup=invalid_email");
                    exit();
                } else{
                    //Check username taken
                    $sql = "SELECT * FROM users WHERE user_uid='$uid'";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if($resultCheck > 0){
                        header("Location: ../accountcreation.php?signup=usern_taken");
                        exit();
                    } else {
                        //Check email taken
                        $sql = "SELECT * FROM users WHERE user_email='$email'";
                        $result = mysqli_query($conn, $sql);
                        $resultCheck = mysqli_num_rows($result);
                        
                        if($resultCheck > 0){
                            header("Location: ../accountcreation.php?signup=email_taken");
                            exit();
                        }else{
                            
                            //Hashing password
                            $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
                            //Generate verify code
                            $code = md5($email.time());
                            //Insert user in db
                            $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pass, user_code) VALUES ('$first', '$last', '$email', '$uid', '$hashedPass', '$code');";
                            mysqli_query($conn, $sql);
                            
                            //send mail
                            /*
                            $to = $email;
                            $subject = "Account activation";
                            
                            $message = "
                                <html>
                                    <head>
                                        <title>Account activation</title>
                                    </head>
                                    <body>
                                        <p> Please click the link provided in this email to activate your account.</p>
                                        <a href='http://localhost/Angle/mailverify.php?email=$email&code=$code'> Click here</a>
                                    </body>
                                </html>
                            ";
                            
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                            
                            $headers .= 'From: <noreply@Angle.com>' . "\r\n";
                            mail($to,$subject,$message,$headers);
                            */
                            
                            //leave
                            header("Location: ../accountcreation.php?signup=succes");
                            exit();
                        }
                    }
                }
            }
        }
    } 
} else{
    header("Location: ../accountcreation.php");
    exit();
}