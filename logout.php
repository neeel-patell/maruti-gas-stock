<?php 
    session_start();
    session_unset(); // unsetting all sessions for mainly a session maintained for login 
    header("location: login.php");
?>