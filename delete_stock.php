<?php
    include_once 'connection.php';
    $conn = getConn();
    $conn->autocommit(false);
    
    $id = $_GET['id'];
    
    if($conn->query("DELETE FROM incoming_stock_item where incoming_stock_id=$id")){
        if($conn->query("DELETE FROM incoming_stock where id=$id")){
            $conn->commit();
            include_once 'refuse_connection.php';
            header("location: view_incoming_stock.php?msg=delPass");
        }
        else{
            include_once 'refuse_connection.php';
            header("location: view_incoming_stock.php?msg=delFail");
        }
    }
    else{
        include_once 'refuse_connection.php';
        header("location: view_incoming_stock.php?msg=delFail");
    }
?>