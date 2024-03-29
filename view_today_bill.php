<?php
    include 'check_login.php';
    include_once 'connection.php';
    $msg = "";
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    $conn = getConn();
    $bill_details = $conn->query("SELECT id,customer_id,purchase_date from bill where purchase_date='".date('Y-m-d')."'");

    ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <title>View Bill</title>
    </head>
    <body>
    	<header class="container-fluid p-4 h4 bg-warning text-black font-monospace m-0" style="min-height: 5vh"><i class="fas fa-car"></i> New Maruti Auto Gas <i class="fas fa-layer-group"></i></header>
    	
    	<?php include 'navbar.php'; ?>
    	
    	<div class="container-fluid p-4" style="min-height: 92vh">
    		
    		<h3 class="text-center">Bills Generated Today [<?php echo date('dS M Y'); ?>]</h3>
    		<hr class="bg-primary">
    		<div class="table-responsive">
    			<table class="table table-bordered text-center">
    				<thead>
        				<tr>
        					<th>Bill No.</th>
        					<th>Name</th>
        					<th>Date</th>
        					<th>Action</th>
        				</tr>
    				</thead>
    				<tbody id="data_table">
    					
    					<?php 
            				while($row = $bill_details->fetch_array()){
            			        $customer_name = $conn->query("SELECT name from customer where id=".$row['customer_id']);
            			        $customer_name = $customer_name->fetch_array();
            		    ?>
    					<tr>
    						<td><?php echo $row['id'];  ?></td>
    						<td><?php echo $customer_name['name']; ?></td>
    						<td><?php echo date_format(date_create($row['purchase_date']),"d M Y"); ?></td>
    						<td>
    							<button class="btn btn-link p-0 text-decoration-none" onclick='location.href="view_bill_items.php?id=<?php echo $row['id']; ?>";'>View Items <i class="fas fa-eye"></i></button>
    						</td>
    					</tr>
    					<?php } ?>
    					
    				</tbody>
    			</table>
    		</div>
    	</div>
    	<script src="js/bootstrap.bundle.js"></script>
    	<script src="js/font-awesome.js"></script>
    	<script src="js/jquery.js"></script>
    	<script src="js/parsley.js"></script>
    </body>
    <?php include_once 'refuse_connection.php'; ?>
</html>