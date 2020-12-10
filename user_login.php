<?php 
    if($_SERVER['REQUEST_METHOD'] != "POST"){ // declining request if it's api or anything(for direct call)
        $_SESSION['logged_in'] = 0;
        header('location: login.php');
    }
    else{
        session_start();
        $email = $_POST['username'];
        $password = $_POST['password'];
        if($email === "admin@marutigas.com" && $password === "Unpredictable"){ // manual password for single user system
            $_SESSION['logged_in'] = 1; // login success, session set for logged in
            header("location: index.php");
        }
        else{
            header("location: login.php?msg=lf"); // login fail
        }
    }
?>