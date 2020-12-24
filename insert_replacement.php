<?php 
    include_once 'connection.php';
    $conn = getConn();
    $conn->autocommit(false);
    
    $date = new DateTime("now", new DateTimeZone('Asia/Kolkata') );
    $date = $date->format('Y-m-d');
    
    $bill_id = $_POST['bill_id'];
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];
   
    $query = "INSERT INTO replaced_items(bill_id,item_id,quantity,replacement_date) VALUES($bill_id,$item_id,$quantity,'$date')";
    if($conn->query($query)){
        $query = "UPDATE item SET current_stock=current_stock-$quantity WHERE id=$item_id";
        if($conn->query($query)){
            $conn->commit();
            include_once 'refuse_connection.php';
            header("location: view_bill_items.php?msg=replaceDone&id=$bill_id");
        }
        else{
            include_once 'refuse_connection.php';
            header("location: view_bill_items.php?msg=replaceFail&id=$bill_id");
        }
    }
    else{
        include_once 'refuse_connection.php';
        header("location: view_bill_items.php?msg=replaceFail&id=$bill_id");
    }
?>