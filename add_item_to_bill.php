<?php 
    require_once 'connection.php';
    $conn = getConn();
    $conn->autocommit(false);
    
    $bill_id = $_POST['bill_id'];
    $quantity = $_POST['quantity'];
    
    preg_match("/\[(\d+)\]/",$_POST['item'],$output);
    $item = $output[1];
    
    $query = "INSERT INTO bill_item(bill_id,item_id,quantity) VALUES($bill_id,$item,$quantity)";
    if($conn->query($query)){
        $query = "UPDATE item SET current_stock=current_stock-$quantity WHERE id=$item";
        if($conn->query($query)){
            $conn->commit();
            require_once 'refuse_connection.php';
            header("location: view_bill_items.php?id=$bill_id&msg=itemAdded");
        }
        else{
            require_once 'refuse_connection.php';
            header("location: view_bill_items.php?id=$bill_id&msg=itemAddFail");
        }
    }
    else{
        require_once 'refuse_connection.php';
        header("location: view_bill_items.php?id=$bill_id&msg=itemAddFail");
    }
?>