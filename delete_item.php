<?php
    include_once 'connection.php';
    $conn = getConn();
    
    $id = $_GET['id'];
    
    if($conn->query("DELETE FROM item where id=$id")){
        header("location: view_item.php?msg=delPass");
    }
    else{
        header("location: view_item.php?msg=delFail");
    }
?>