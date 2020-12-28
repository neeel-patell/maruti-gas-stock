<?php
    include 'check_login.php';
    include_once 'connection.php';
    $msg = "";
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    $conn = getConn();
    $replacement = $conn->query("SELECT bill_id,item_id,quantity,replacement_date from replaced_items where dispatched=0");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <title>View Undispatched Replacement</title>
    </head>
    <body>
    	<header class="container-fluid p-4 h4 bg-warning text-black font-monospace m-0" style="min-height: 5vh"><i class="fas fa-car"></i> New Maruti Auto Gas <i class="fas fa-layer-group"></i></header>
    	
    	<?php include 'navbar.php'; ?>
    	
    	<div class="container-fluid p-4" style="min-height: 92vh">
    		<h3 class="text-center">Undispatched Replacements</h3>
    		<hr class="bg-primary">
    		<div class="table-responsive">
    			<table class="table table-bordered text-center">
    				<thead>
        				<tr>
        					<th>Bill No.</th>
        					<th>Date</th>
        					<th>Customer Name</th>
        					<th>Item</th>
        					<th>Quantity</th>
        					<th>Action</th>
        				</tr>
    				</thead>
    				<tbody>
    					
    					<?php 
            				while($row = $replacement->fetch_array()){
            				    $bill = $conn->query("SELECT customer_id from bill where id=".$row['bill_id']);
            				    $bill = $bill->fetch_array();
            				    $customer_name = $conn->query("SELECT name from customer where id=".$bill['customer_id']);
            				    $customer_name = $customer_name->fetch_array();
            				    $item_name = $conn->query("SELECT name from item where id=".$row['item_id']);
            				    $item_name = $item_name->fetch_array();
            			        
            		    ?>
    					<tr>
    						<td><?php echo $row['bill_id'];  ?></td>
    						<td><?php echo date_format(date_create($row['replacement_date']),"d M Y"); ?></td>
    						<td><?php echo $customer_name['name']; ?></td>
    						<td><?php echo $item_name['name']; ?></td>
    						<td><?php echo $row['quantity']; ?></td>
    						<td>
    							<button class="btn btn-link p-0 text-decoration-none" onclick='location.href="view_bill_items.php?id=<?php echo $row['bill_id']; ?>";'>View Bill <i class="fas fa-eye"></i></button>
    						</td>
    					</tr>
    					<?php } ?>
    					
    				</tbody>
    			</table>
    		</div>
    	</div>
    	<script src="js/bootstrap.bundle.js"></script>
    	<script src="js/font-awesome.js"></script>
    </body>
    <?php include_once 'refuse_connection.php'; ?>
</html>