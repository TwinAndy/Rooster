<?php
if(isset($_POST['register-submit'])){
    require 'dbh.php';

    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

    if(empty($first) || empty($last) || empty($email) || empty($pass)){

      exit();
    }else{

    }
}
