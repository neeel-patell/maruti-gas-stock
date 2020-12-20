<?php 
    require_once 'connection.php';
    $conn = getConn();
    $conn->autocommit(false);
    
    $kit_id = $_POST['kit_id'];
    $quantity = $_POST['quantity'];
    
    preg_match("/\[(\d+)\]/",$_POST['item'],$output);
    $item = $output[1];
    
    $query = "INSERT INTO kit_items(kit_id,item_id,quantity) VALUES($kit_id,$item,$quantity)";
    if($conn->query($query)){
        $conn->commit();
        require_once 'refuse_connection.php';
        header("location: view_kit_item.php?id=$kit_id&msg=itemAdded");
    }
    else{
        require_once 'refuse_connection.php';
        header("location: view_kit_item.php?id=$kit_id&msg=itemAddFail");
    }
    
?>