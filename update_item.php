<?php 
    include_once 'connection.php';
    $conn = getConn();
    
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = str_replace("'","\'",$_POST['description']);
    
    $query = "UPDATE item SET
              name = '$name',
              description = '$description'
              where id = $id";
    if($conn->query($query)){
        header("location: view_item.php?msg=editPass");
    }
    else{
        header("location: view_item.php?msg=editFail");
    }
    include_once 'refuse_connection.php';
?>