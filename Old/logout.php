<?php

if (isset($_POST['submit'])){
    if(session_status()!=PHP_SESSION_ACTIVE) {session_start();}
    session_unset();
    session_destroy();
    header("Location: ../index.php?logout=succes");
    exit();
}