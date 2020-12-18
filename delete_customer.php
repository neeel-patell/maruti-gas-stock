<?php
    include_once 'connection.php';
    $conn = getConn();
    
    $id = $_GET['id'];
    
    if($conn->query("DELETE FROM customer where id=$id")){
        include_once 'refuse_connection.php';
        header("location: view_customer.php?msg=delPass");
    }
    else{
        include_once 'refuse_connection.php';
        header("location: view_customer.php?msg=delFail");
    }
    
?>