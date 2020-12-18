<?php 
    require_once 'connection.php';
    $conn = getConn();
    $conn->autocommit(false);
    
    preg_match("/\[(\d+)\]/", $_POST['supplier'], $output);
    $supplier = $output[1];
    
    $date = str_replace("-", "/", $_POST['stock_date']);
    
    $items = array();
    
    $query_flag = 1;
    
    $i = 1;
    while(isset($_POST['item'.$i])){
        preg_match("/\[(\d+)\]/",$_POST['item'.$i],$output);
        $item = $output[1];
        array_push($items, array($item,$_POST['quantity'.$i],$_POST['price'.$i]));
        $i++;
    }
    
    $query = "INSERT INTO incoming_stock(supplier_id,date_time) VALUES($supplier,'$date')";
    if($conn->query($query)){
        $insert_id = $conn->insert_id;
        foreach($items as $arr){
            $query = "INSERT INTO incoming_stock_item(incoming_stock_id,item_id,quantity,price) VALUES($insert_id,$arr[0],$arr[1],$arr[2])";
            if($conn->query($query)){
                $query = "UPDATE item set current_stock=current_stock+$arr[1] where id=$item";
                if($conn->query($query) == false){
                    $query_flag = 0;
                }
            }
            else{
                $query_flag = 0;
            }
        }
    }
    else{
        $query_flag = 0;
    }
    
    if($query_flag == 0){
        header("add_stock.php?msg=fail");
    }
    else{
        $conn->commit();
        header("location: add_stock.php?msg=pass");
    }
    
    require_once 'refuse_connection.php';
?>