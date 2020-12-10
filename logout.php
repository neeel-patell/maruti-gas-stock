<?php 
    session_start();
    session_unset(); // unsetting all sessions, mainly for a session maintained for login 
    header("location: login.php");
?>