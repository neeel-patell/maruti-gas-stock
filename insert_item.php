<?php 
    include_once 'connection.php';
    $conn = getConn();
    
    $name = $_POST['name'];
    $description = $_POST['description'];
    $description = str_replace("'", "\'", $description);
        
    $query = "INSERT INTO item(name,description) VALUES('$name','$description')";
    if($conn->query($query)){
        header("location: add_item.php?msg=pass");
    }
    else{
        header("location: add_item.php?msg=fail");
    }
    include_once 'refuse_connection.php';
?>