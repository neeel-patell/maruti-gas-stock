<?php
    include_once 'connection.php';
    $conn = getConn();
    $conn->autocommit(false);
    
    $id = $_GET['id'];
    
    $incoming_stock_detail = $conn->query("SELECT incoming_stock_id,item_id,quantity FROM incoming_stock_item where id=$id");
    $incoming_stock_detail= $incoming_stock_detail->fetch_array();
    
    $query = "UPDATE item
              SET current_stock = current_stock - ".$incoming_stock_detail['quantity'].
              " where id=".$incoming_stock_detail['item_id'];
    
    if($conn->query($query)){
        if($conn->query("DELETE FROM incoming_stock_item where id=$id")){
            $conn->commit();
            include_once 'refuse_connection.php';
            header("location: view_incoming_stock_items.php?msg=delItem&id=".$incoming_stock_detail['incoming_stock_id']);
        }
        else{
            
            include_once 'refuse_connection.php';
            header("location: view_incoming_stock_items.php?msg=delItemFail&id=".$incoming_stock_detail['incoming_stock_id']);
        }
    }
    else{
        include_once 'refuse_connection.php';
        header("location: view_incoming_stock_items.php?msg=delItemFail&id=".$incoming_stock_detail['incoming_stock_id']);
    }
?>