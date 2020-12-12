<?php 
    include_once 'connection.php';
    $conn = getConn();
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    
    $query = "UPDATE supplier SET
              name = '$name',
              address = '$address',
              contact = $contact
              where id = $id";
    if($conn->query($query)){
        header("location: view_supplier.php?msg=pass");
    }
    else{
        header("location: view_supplier.php?msg=fail");
    }
?>