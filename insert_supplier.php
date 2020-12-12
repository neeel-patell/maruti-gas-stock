<?php 
    include_once 'connection.php';
    $conn = getConn();
    
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    
    $query = "INSERT INTO supplier(name,address,contact) VALUES('$name','$address',$contact)";
    if($conn->query($query)){
        header("location: add_supplier.php?msg=pass");
    }
    else{
        header("location: add_supplier.php?msg=fail");
    }
    include_once 'refuse_connection.php';
?>