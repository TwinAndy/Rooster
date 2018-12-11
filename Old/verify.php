<?php

if(session_status()!=PHP_SESSION_ACTIVE) {session_start();}

if (isset($_POST['submit'])){
    $_SESSION['email_verify'] = null;
    header("Location: ../index.php");
    exit();
}
if (isset($_POST['resend'])){
    $_SESSION['email_verify'] = null;
    header("Location: ../index.php");
    exit();
}