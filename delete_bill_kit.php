<?php
    include_once 'connection.php';
    $conn = getConn();
    $conn->autocommit(false);
    $query_flag = 1;
    
    $id = $_GET['id'];
    
    $bill_kit = $conn->query("SELECT bill_id,kit_id,quantity FROM bill_kit where id=$id");
    $bill_kit = $bill_kit->fetch_array();
    
    $query = "DELETE FROM bill_kit WHERE id=$id";
    if($conn->query($query)){
        $query = "SELECT item_id,quantity FROM kit_items WHERE kit_id=".$bill_kit['kit_id'];
        $kit_details = $conn->query($query);
        
        while($row = $kit_details->fetch_array()){
            $item = $row['item_id'];
            $quantity = $bill_kit['quantity'] * $row['quantity'];
            $query = "UPDATE item SET current_stock=current_stock+$quantity WHERE id=$item";
            if($conn->query($query) == false){
                $query_flag = 0;
            }
        }
    }
    else{
        $query_flag = 0;
    }
    
    
    if($query_flag == 0){
        echo $conn->error;
        include_once 'refuse_connection.php';
        //header("location: view_bill_items.php?msg=delKitFail&id=".$bill_kit['bill_id']);
    }
    else{
        $conn->commit();
        include_once 'refuse_connection.php';
        header("location: view_bill_items.php?msg=delKit&id=".$bill_kit['bill_id']);
    }
?>