<?php
    include_once 'connection.php';
    $conn = getConn();
    $conn->autocommit(false);
    
    $id = $_GET['id'];
    
    $bill_item = $conn->query("SELECT bill_id,item_id,quantity FROM bill_item where id=$id");
    $bill_item = $bill_item->fetch_array();
    
    $query = "UPDATE item
              SET current_stock = current_stock + ".$bill_item['quantity'].
              " where id=".$bill_item['item_id'];
    
    if($conn->query($query)){
        if($conn->query("DELETE FROM bill_item where id=$id")){
            $conn->commit();
            include_once 'refuse_connection.php';
            header("location: view_bill_items.php?msg=delItem&id=".$bill_item['bill_id']);
        }
        else{
            
            include_once 'refuse_connection.php';
            header("location: view_bill_items.php?msg=delItemFail&id=".$bill_item['bill_id']);
        }
    }
    else{
        include_once 'refuse_connection.php';
        header("location: view_bill_items.php?msg=delItemFail&id=".$bill_item['bill_id']);
    }
?>