<?php
    if(session_status()!=PHP_SESSION_ACTIVE) {session_start();}
    
    if(isset($_SESSION['u_id'])){
        header("Location: home.php");
    }
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Angle</title>
        <link rel="stylesheet" href="css/LogIn.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/animate.js"></script>
    </head>
    <body>
        
        <div class="login-page">
            <div class="form">
                <form class="reset-form" method="POST" action="php/forgotpass.php">
                    <p class="title">Request password reset</p>
                    <input type="text" name="uid" placeholder="E-mail"/>
                    <button type="submit" name="submit">Request password reset</button>
                    <p class="message">Got your password? <a href="#">Go back</a></p>
                </form>
                <?php 
                    if(empty($_SESSION['email_verify'])){
                        echo '<form class="login-form" method="POST" action="php/login.php">
                            <p class="title">Log in</p>';
                        
                        if(!empty($_GET["message"])){
                            $message = $_GET["message"];
                            
                            if($message == "error"){
                                echo '<p class="message">Something went wrong.</p>';
                            }elseif($message == "loginempty"){
                                echo '<p class="message">A field is left empty.</p>';
                            }elseif($message == "verifycomplete"){
                                echo '<p class="message">Your email has been verified!</p>';
                            }elseif($message == "incorrect"){
                                echo '<p class="message">Incorrect username or password</p>';
                            }
                        }
                        
                        echo '<input type="text" name="uid" placeholder="Username/e-mail"/>
                            <input type="password" name="pass" placeholder="Password"/>
                            <button type="submit" name="submit">Log in</button>
                            <p class="message">Forgot your password? <a href="#">Request a password reset</a></p>
                        </form>';
                    }else{
                        echo '
                        <form class="verify-form" method="POST" action="php/verify.php"> 
                            <p class="title">Log in</p>
                            <p class="message">Your email still needs to be verified.</p>
                            <button type="submit" name="submit">Go back</button>
                            <p class="message">No email yet? <button id="mail" type="submit" name="resend">Send new mail</button></p>
                        </form>';
                    }
                ?>
            </div>
        </div>
        
        
        

    </body>
</html>
