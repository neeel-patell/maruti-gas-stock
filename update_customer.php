<?php 
    include_once 'connection.php';
    $conn = getConn();
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    
    $query = "UPDATE customer SET
              name = '$name',
              mobile = $mobile,
              email = '$email'
              where id = $id";
    if($conn->query($query)){
        require_once 'refuse_connection.php';
        header("location: view_customer.php?msg=editPass");
    }
    else{
        require_once 'refuse_connection.php';
        header("location: view_customer.php?msg=editFail");
    }
?>