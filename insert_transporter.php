<?php 
    include_once 'connection.php';
    $conn = getConn();
    
    $name = $_POST['name'];
    $transport_id = $_POST['transport_id'];
    $bill_id = $_POST['bill'];
    
    $query = "INSERT INTO bill_transporter(transported_by,transport_id,bill_id) VALUES('$name','$transport_id',$bill_id)";
    if($conn->query($query)){
        include_once 'refuse_connection.php';
        header("location: view_bill_items.php?msg=passTransport&id=$bill_id");
    }
    else{
        include_once 'refuse_connection.php';
        header("location: view_bill_items.php?msg=failTransport&id=$bill_id");
    }
?>