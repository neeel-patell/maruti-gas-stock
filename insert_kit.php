<?php 
    require_once 'connection.php';
    $conn = getConn();
    $conn->autocommit(false);
    
    $items = array();
    
    $name = $_POST['name'];
    $query_flag = 1;
    
    $i = 1;
    while(isset($_POST['item'.$i])){
        preg_match("/\[(\d+)\]/",$_POST['item'.$i],$output);
        $item = $output[1];
        array_push($items, array($item,$_POST['quantity'.$i]));
        $i++;
    }

    $query = "INSERT INTO kit(name) VALUES('$name')";
    if($conn->query($query)){
        $insert_id = $conn->insert_id;
        foreach($items as $arr){
            $query = "INSERT INTO kit_items(kit_id,item_id,quantity) VALUES($insert_id,$arr[0],$arr[1])";
            if($conn->query($query) == false){
                $query_flag = 0;
                break;
            }
        }
    }
    else{
        $query_flag = 0;
    }
    
    if($query_flag == 0){
        require_once 'refuse_connection.php';
        header("location: add_kit.php?msg=fail");
    }
    else{
        $conn->commit();
        require_once 'refuse_connection.php';
        header("location: add_kit.php?msg=pass");
    }
?>