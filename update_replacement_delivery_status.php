<?php 
    include_once 'connection.php';
    $conn = getConn();
    
    $id = $_GET['id'];
    
    $query = "SELECT bill_id,dispatched FROM replaced_items WHERE id=$id";
    $replaced_items = $conn->query($query);
    $replaced_items = $replaced_items->fetch_array();
    
    $dispatched = $replaced_items['dispatched'] == 0 ? 1 : 0;
    
    $query = "UPDATE replaced_items SET dispatched=$dispatched WHERE id=$id";
    if($conn->query($query)){
        include_once 'refuse_connection.php';
        header('location: view_bill_items.php?msg=statusChange&id='.$replaced_items['bill_id']);
    }
    else{
        include_once 'refuse_connection.php';
        header('location: view_bill_items.php?msg=statusChangeFail&id='.$replaced_items['bill_id']);
    }
    
?>