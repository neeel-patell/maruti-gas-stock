<?php
    include_once 'connection.php';
    $conn = getConn();
    
    $id = $_GET['id'];
    $kit = $_GET['kit'];
    
    if($conn->query("DELETE FROM kit_items where id=$id")){
        header("location: view_kit_item.php?msg=delPass&id=$kit");
    }
    else{
        header("location: view_kit_item.php?msg=delFail&id=$kit");
    }
    include_once 'refuse_connection.php';
?>