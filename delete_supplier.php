<?php
    include_once 'connection.php';
    $conn = getConn();
    
    $id = $_GET['id'];
    
    if($conn->query("DELETE FROM supplier where id=$id")){
        require_once 'refuse_connection.php';
        header("location: view_supplier.php?msg=delPass");
    }
    else{
        require_once 'refuse_connection.php';
        header("location: view_supplier.php?msg=delFail");
    }
?>