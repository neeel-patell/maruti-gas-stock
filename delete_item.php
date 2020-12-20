<?php
    include_once 'connection.php';
    $conn = getConn();
    
    $id = $_GET['id'];
    
    if($conn->query("DELETE FROM item where id=$id")){
        require_once 'refuse_connection.php';
        header("location: view_item.php?msg=delPass");
    }
    else{
        require_once 'refuse_connection.php';
        header("location: view_item.php?msg=delFail");
    }
?>