<?php 
    require_once 'connection.php';
    $conn = getConn();
    $conn->autocommit(false);
    
    $bill_id = $_POST['bill_id'];
    $quantity = $_POST['quantity'];
    
    preg_match("/\[(\d+)\]/",$_POST['kit'],$output);
    $kit = $output[1];
    
    $query = "INSERT INTO bill_kit(bill_id,kit_id,quantity) VALUES($bill_id,$kit,$quantity)";
    if($conn->query($query)){
        $query = "SELECT item_id,quantity from kit_items where kit_id=$kit";
        $kit_items = $conn->query($query);
        while($row = $kit_items->fetch_array()){
            $quantity = $quantity * $row['quantity'];
            $item = $row['item_id'];
            $query = "UPDATE item SET current_stock=current_stock-$quantity WHERE id=$item";
            if($conn->query($query) == false){
                require_once 'refuse_connection.php';
                header("location: view_bill_items.php?id=$bill_id&msg=kitAddFail");
            }
        }
        $conn->commit();
        require_once 'refuse_connection.php';
        header("location: view_bill_items.php?id=$bill_id&msg=kitAdded");
    }
    else{
        require_once 'refuse_connection.php';
        header("location: view_bill_items.php?id=$bill_id&msg=kitAddFail");
    }
?>