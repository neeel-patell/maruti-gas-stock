<?php 
    if($_SERVER['REQUEST_METHOD'] != "POST"){
        $_SESSION['logged_in'] = 0;
        header('location: login.php');
    }
    else{
        session_start();
        $email = $_POST['username'];
        $password = $_POST['password'];
        if($email === "admin@marutigas.com" && $password === "Unpredictable"){
            $_SESSION['logged_in'] = 1;
            header("location: index.php");
        }
        else{
            header("location: login.php?msg=lf");
        }
    }
?>