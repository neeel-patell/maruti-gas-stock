<?php
    include_once 'connection.php';
    $conn = getConn();
    
    $id = $_GET['id'];
    
    if($conn->query("DELETE FROM supplier where id=$id")){
        header("location: view_supplier.php?msg=delPass");
    }
    else{
        header("location: view_supplier.php?msg=delFail");
    }
    include_once 'refuse_connection.php';
?>