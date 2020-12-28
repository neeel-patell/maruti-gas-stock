<?php
    include_once 'connection.php';
    $conn = getConn();
    
    $id = $_GET['id'];
    
    if($conn->query("DELETE FROM replaced_items where item_id=$id")){
        require_once 'refuse_connection.php';
        header("location: view_replacement.php?msg=delPass");
    }
    else{
        require_once 'refuse_connection.php';
        header("location: view_replacement.php?msg=delFail");
    }
?>