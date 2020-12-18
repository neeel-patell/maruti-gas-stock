<?php 
    require_once 'connection.php';
    $conn = getConn();
    $conn->autocommit(false);
    
    $incoming_stock_id = $_POST['incoming_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    
    preg_match("/\[(\d+)\]/",$_POST['item'],$output);
    $item = $output[1];
    
    $query = "INSERT INTO incoming_stock_item(incoming_stock_id,item_id,quantity,price) VALUES($incoming_stock_id,$item,$quantity,$price)";
    if($conn->query($query)){
        $query = "UPDATE item set current_stock=current_stock+$quantity where id=$item";
        if($conn->query($query)){
            $conn->commit();
            require_once 'refuse_connection.php';
            header("location: view_incoming_stock_items.php?id=$incoming_stock_id");
        }
        else{
            require_once 'refuse_connection.php';
            header("location: view_incoming_stock_items.php?id=$incoming_stock_id");
        }
    }
    else{
        require_once 'refuse_connection.php';
        header("location: view_incoming_stock_items.php?id=$incoming_stock_id");
    }
    
?>