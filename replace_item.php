<?php
    include 'check_login.php';
    include_once 'connection.php';
    $id = 0;
    $msg = "";
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    if($id == 0){
        header('location: view_incoming_stock.php');
    }
    $conn = getConn();
    $bill = $conn->query("SELECT customer_id,purchase_date from bill where id=$id");
    $bill = $bill->fetch_array();
    
    $customer = $conn->query("SELECT name,type FROM customer where id=".$bill['customer_id']);
    $customer = $customer->fetch_array();
    
    
    $sr = 1;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <title>Replace Item</title>
    </head>
    <body>
    	<header class="container-fluid p-4 h4 bg-warning text-black font-monospace m-0" style="min-height: 5vh"><i class="fas fa-car"></i> New Maruti Auto Gas <i class="fas fa-layer-group"></i></header>
    	
    	<?php include 'navbar.php'; ?>
    	
    	<div class="container-fluid p-4" style="min-height: 92vh">
    	
    		<h6>Invoice Number : <?php echo $id; ?></h6>
    		
    		<h6>Customer Name : <?php echo $customer['name']; ?></h6>
    		<h6>Date : <?php echo date_format(date_create($bill['purchase_date']),'dS M Y'); ?></h6>
    		
    		<div class="table-responsive mt-5">
    			
    		</div>
    	</div>
    	<script src="js/bootstrap.bundle.js"></script>
    	<script src="js/font-awesome.js"></script>
    </body>
    <?php include_once 'refuse_connection.php'; ?>
</html>