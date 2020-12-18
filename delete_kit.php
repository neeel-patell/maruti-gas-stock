<?php
    include_once 'connection.php';
    $conn = getConn();
    $conn->autocommit(false);
    
    $id = $_GET['id'];
    
    if($conn->query("DELETE FROM kit_items where kit_id=$id")){
        if($conn->query("DELETE FROM kit where id=$id")){
            $conn->commit();
            include_once 'refuse_connection.php';
            header("location: view_kit.php?msg=delPass");
        }
        else{
            include_once 'refuse_connection.php';
            header("location: view_kit.php?msg=delFail");
        }
    }
    else{
        include_once 'refuse_connection.php';
        header("location: view_kit.php?msg=delFail");
    }
?>