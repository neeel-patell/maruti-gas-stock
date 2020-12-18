<?php 
    include_once 'connection.php';
    $conn = getConn();
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $type = $_POST['type'];
    
    $query = "INSERT INTO customer(first_name,last_name,mobile,email,type) VALUES('$first_name','$last_name',$mobile,'$email',$type)";
    if($conn->query($query)){
        include_once 'refuse_connection.php';
        header("location: add_customer.php?msg=pass");
    }
    else{
        include_once 'refuse_connection.php';
        header("location: add_customer.php?msg=fail");
    }
?>