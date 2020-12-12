<?php
    session_start();
    if(isset($_SESSION['logged_in'])){
        if($_SESSION['logged_in'] != 1){ // checking weather user is logged in or not
            header("location: login.php?msg=la"); // if not logged in then redirecting back to login page
        }
    }
?>