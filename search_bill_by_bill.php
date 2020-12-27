<?php
    include_once 'connection.php';
    $conn = getConn();
    $bill = $_POST['bill'];
    
    $data = array();
    
    $bills = $conn->query("SELECT id,customer_id,purchase_date from bill where id=$bill");
    while($row = $bills->fetch_array()){
        $customer_name = $conn->query("SELECT name FROM customer WHERE id=".$row['customer_id']);
        $customer_name = $customer_name->fetch_array();
        array_push($data,array('id'=>$row['id'],'customer_name'=>$customer_name['name'],'purchase_date'=>date_format(date_create($row['purchase_date']),'d M Y')));
    }
    
    echo json_encode($data);
    include_once 'refuse_connection.php';
?>