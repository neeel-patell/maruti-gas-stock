<?php 
    include_once 'connection.php';
    $conn = getConn();
    
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $type = $_POST['type'];
    
    $query = "INSERT INTO customer(name,mobile,email,type) VALUES('$name',$mobile,'$email',$type)";
    if($conn->query($query)){
        include_once 'refuse_connection.php';
        header("location: add_customer.php?msg=pass");
    }
    else{
        include_once 'refuse_connection.php';
        header("location: add_customer.php?msg=fail");
    }
?>