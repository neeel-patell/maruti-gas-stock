<?php 
    include_once 'connection.php';
    $conn = getConn();
    
    $name = $_POST['name'];
    $description = $_POST['description'];
    $description = str_replace("'", "\'", $description);
    $current = $_POST['current'];
        
    $query = "INSERT INTO item(name,description,current_stock) VALUES('$name','$description',$current)";
    if($conn->query($query)){
        header("location: add_item.php?msg=pass");
    }
    else{
        echo $conn->error;
        //header("location: add_item.php?msg=fail");
    }
    include_once 'refuse_connection.php';
?>