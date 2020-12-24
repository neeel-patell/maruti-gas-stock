<?php 
    require_once 'connection.php';
    $conn = getConn();
    $conn->autocommit(false);
    
    preg_match("/\[(\d+)\]/", $_POST['customer_name'], $output);
    $customer = $output[1];
    $date = str_replace("-", "/", $_POST['bill_date']);
   
    $items = $kits = array();
   
    $query_flag = 1;
    
    $i = 1;
    while(isset($_POST['item'.$i])){
        preg_match("/\[(\d+)\]/",$_POST['item'.$i],$output);
        $item = $output[1];
        array_push($items, array($item,$_POST['item_quantity'.$i]));
        $i++;
    }
    
    $j = 1;
    while(isset($_POST['kit'.$j])){
        preg_match("/\[(\d+)\]/",$_POST['kit'.$j],$output);
        $kit = $output[1];
        array_push($kits, array($kit,$_POST['kit_quantity'.$j]));
        $j++;
    }
    
    $query = "INSERT INTO bill(customer_id,purchase_date) values($customer,'$date')";
    if($conn->query($query)){
        $bill_id = $conn->insert_id;
        $i = 0;
        while(isset($items[$i])){
            $item_id = $items[$i][0];
            $quantity = $items[$i][1];
            $query = "INSERT INTO bill_item(bill_id,item_id,quantity) VALUES($bill_id,$item_id,$quantity)";
            if($conn->query($query)){
                $query = "UPDATE item SET current_stock=current_stock-$quantity WHERE id=$item_id";
                if($conn->query($query) == false){
                    $query_flag = 0;
                    break;
                }
            }
            else{
                $query_flag = 0;
                break;
            }
            $i++;
        }
        $i = 0;
        while(isset($kits[$i])){
            $kit_id = $kits[$i][0];
            $kit_quantity = $kits[$i][1];
            $query = "INSERT INTO bill_kit(bill_id,kit_id,quantity) VALUES($bill_id,$kit_id,$kit_quantity)";
            if($conn->query($query)){
                $query = "SELECT item_id,quantity from kit_items where kit_id=$kit_id";
                $kit_items = $conn->query($query);
                while($row = $kit_items->fetch_array()){
                    $quantity = $kit_quantity * $row['quantity'];
                    $item = $row['item_id'];
                    $query = "UPDATE item SET current_stock=current_stock-$quantity WHERE id=$item";
                    if($conn->query($query) == false){
                        $query_flag = 0;
                        break;
                    }
                }
            }
            else{
                $query_flag = 0;
                break;
            }
            $i++;
        }
    }
    else {
        $query_flag = 0;
    }
    
    if($query_flag == 0){
        echo $query;
        require_once 'refuse_connection.php';
        //header("location: sell_item.php?msg=fail");
    }
    else{
        $conn->commit();
        require_once 'refuse_connection.php';
        header("location: sell_item.php?msg=pass");
    }
?>