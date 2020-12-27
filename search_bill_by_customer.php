<?php
    include_once 'connection.php';
    $conn = getConn();
    $name = $_POST['name'];
    
    $customer_ids = "";
    $data = array();
    
    $query = "SELECT id from customer WHERE name like('%$name%')";
    $customers = $conn->query($query);
    while($row = $customers->fetch_array()){
        $customer_ids .= $row['id'].",";
    }
    if($customer_ids != ""){
        $customer_ids[-1] = " ";
        
        $bills = $conn->query("SELECT id,customer_id,purchase_date from bill where customer_id in($customer_ids) ORDER BY purchase_date DESC");
        while($row = $bills->fetch_array()){
            $customer_name = $conn->query("SELECT name FROM customer WHERE id=".$row['customer_id']);
            $customer_name = $customer_name->fetch_array();
            array_push($data,array('id'=>$row['id'],'customer_name'=>$customer_name['name'],'purchase_date'=>date_format(date_create($row['purchase_date']),'d M Y')));
        }
    }
    
    echo json_encode($data);
    include_once 'refuse_connection.php';
?>