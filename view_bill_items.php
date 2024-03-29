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
    
    $bill_items = $conn->query("SELECT id,item_id,quantity from bill_item where bill_id=$id");
    $bill_kits = $conn->query("SELECT id,kit_id,quantity from bill_kit where bill_id=$id");
    
    $item_list = $conn->query("SELECT id,name FROM item ORDER BY name");
    $kit_list = $conn->query("SELECT id,name FROM kit ORDER BY name");
    $sr = 1;
    
    $replaced_items = $conn->query("SELECT id,item_id,quantity,replacement_date,dispatched FROM replaced_items where bill_id=$id");
    
    $transporter = $conn->query("SELECT transport_id,transported_by from bill_transporter where bill_id=$id");
    $transporter_count = mysqli_num_rows($transporter);
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <title>View Bill Items</title>
    </head>
    <body>
    	<header class="container-fluid p-4 h4 bg-warning text-black font-monospace m-0" style="min-height: 5vh"><i class="fas fa-car"></i> New Maruti Auto Gas <i class="fas fa-layer-group"></i></header>
    	
    	<?php include 'navbar.php'; ?>
    	
    	<div class="container-fluid p-4" style="min-height: 92vh">
    	
    		<?php if($msg == "delItem"){ ?>
			<div class="alert alert-success h6 text-center">Item is removed from current bill !...</div>
			<?php }else if($msg == "delItemFail"){ ?>
			<div class="alert alert-danger h6 text-center">Something went wrong while removing Item !...</div>
			<?php }else if($msg == "delKit"){ ?>
			<div class="alert alert-success h6 text-center">Kit is removed from current bill !..</div>
			<?php }else if($msg == "delKitFail"){ ?>
			<div class="alert alert-danger h6 text-center">Something went wrong while removing Kit !...</div>
			<?php }else if($msg == "itemAdded"){ ?>
			<div class="alert alert-success h6 text-center">Item is Successfully added in a bill !...</div>
			<?php }else if($msg == "itemAddFail"){ ?>
			<div class="alert alert-danger h6 text-center">Item is not added, please try again !...</div>
			<?php }else if($msg == "kitAdded"){ ?>
			<div class="alert alert-success h6 text-center">Kit is Successfully added in a bill !...</div>
			<?php }else if($msg == "kitAddFail"){ ?>
			<div class="alert alert-danger h6 text-center">Kit is not added, please try again !...</div>
			<?php }else if($msg == "replaceDone"){ ?>
			<div class="alert alert-success h6 text-center">Replacement is Successfully done as per bill !...</div>
			<?php }else if($msg == "replaceFail"){ ?>
			<div class="alert alert-danger h6 text-center">Replacement is not added, please try again !...</div>
			<?php }else if($msg == "statusChange"){ ?>
			<div class="alert alert-success h6 text-center">Status is Successfully changed for Delivery !...</div>
			<?php }else if($msg == "statusChangeFail"){ ?>
			<div class="alert alert-danger h6 text-center">Status is not changed for Delivery, PLease try again !...</div>
			<?php }else if($msg == "passTransport"){ ?>
			<div class="alert alert-success h6 text-center">Transporter is Successfully set for Delivery !...</div>
			<?php }else if($msg == "failTransport"){ ?>
			<div class="alert alert-danger h6 text-center">Transporter is not set for Delivery, PLease try again !...</div>
			<?php } ?>
    		
    		<h6>Invoice Number : <?php echo $id; ?></h6>
    		
    		<h6>Customer Name : <?php echo $customer['name']; ?></h6>
    		<h6>Date : <?php echo date_format(date_create($bill['purchase_date']),'dS M Y'); ?></h6>
    		
    		<?php if($customer['type'] == 1){ ?>
    		<div>
    			<span class="h6">Transported By :</span> 
    			<?php if($transporter_count == 0){ ?>
    				<form class="form-inline" method="post" action="insert_transporter.php">
    					<input type="hidden" name="bill" value="<?php echo $id; ?>"> 
    					<div class="input-group">
    						<input class="form-control" name="name" placeholder="Enter Name" maxlength="30" required>
    						<input class="form-control" name="transport_id" placeholder="Enter Transport ID" maxlength="20" required>
    						<input class="btn btn-success" type="submit" value="Add">
    					</div>
    					
    				</form>
    			<?php }else{
    				$transporter = $transporter->fetch_array();
    				echo $transporter['transported_by']." [".$transporter['transport_id']."]";
    			 } ?>
    		</div>
    		<?php } ?>
    		
    		<div class="table-responsive mt-5">
    			<table class="table table-bordered text-center">
    				<thead>
        				<tr>
        					<th>Sr No.</th>
        					<th>Item / Kit</th>
        					<th>Quantity</th>
        				</tr>
    				</thead>
    				<tbody>
    					
    					<?php 
            				while($row = $bill_items->fetch_array()){
            			        $item_name = $conn->query("SELECT name from item where id=".$row['item_id']);
            			        $item_name = $item_name->fetch_array();
            		    ?>
            		    
    					<tr>
    						<td><?php echo $sr++; ?></td>
    						<td><?php echo $item_name['name']; ?></td>
    						<td><?php echo $row['quantity']; ?></td>
    						<td>
    							<button class="btn btn-link p-0 text-decoration-none" onclick='if(confirm("Do you want to remove item ? ")){ location.href="delete_bill_item.php?id=<?php echo $row['id']; ?>"; }'><i class="fas fa-minus-circle"></i> Remove</button> 
    						</td>
    					</tr>
    					<?php } ?>
    					
    					<?php 
    					    $collapse = 0;
            				while($row = $bill_kits->fetch_array()){
            				    $collapse++;
            			        $item_name = $conn->query("SELECT name from kit where id=".$row['kit_id']);
            			        $item_name = $item_name->fetch_array();
            		    ?>
            		    
    					<tr>
    						<td><?php echo $sr++; ?></td>
    						<td><?php echo $item_name['name']; ?> (Kit)</td>
    						<td><?php echo $row['quantity']; ?></td>
    						<td>
    							<button class="btn btn-link p-0 text-decoration-none" onclick='if(confirm("Do you want to remove item ? ")){ location.href="delete_bill_kit.php?id=<?php echo $row['id']; ?>"; }'><i class="fas fa-minus-circle"></i> Remove</button> 
   	 						</td>
    						
    					</tr>
    					<?php } ?>
    					
    				</tbody>
    				<tfoot>
    					<tr>
    						<td colspan="4" class="text-center">
    							<button class="btn btn-success" onclick="document.getElementById('add_more_item').style.display ='block'"><i class="fas fa-plus-square"></i> Add Item</button>
    							<button class="btn btn-success" onclick="document.getElementById('add_more_kit').style.display ='block'"><i class="fas fa-plus-square"></i> Add Kit</button>
    							<button class="btn btn-success" onclick='location.href="replace_item.php?id=<?php echo $id; ?>"'><i class="fas fa-exchange-alt"></i> Replace</button>
    						</td>
    					</tr>
    				</tfoot>
    			</table>
    			
    			<table class="table table-bordered text-center">
    				<thead>
    					<tr>
    						<th colspan="5	" class="text-center h6">Replaced Items</th>
    					</tr>
        				<tr>
        					<th>Sr No.</th>
        					<th>Date</th>
        					<th>Item</th>
        					<th>Dispatch</th>
        					<th>Quantity</th>
        				</tr>
    				</thead>
    				<tbody>
    					<?php
    					   $sr = 1;
    					   while($row = $replaced_items->fetch_array()){
    					       $item_name = $conn->query("SELECT name from item where id=".$row['item_id']);
    					       $item_name = $item_name->fetch_array();
    					?>
    						<tr>
    							<td><?php echo $sr++; ?></td>
    							<td><?php echo date_format(date_create($row['replacement_date']),'dS M Y'); ?></td>
    							<td><?php echo $item_name['name']; ?></td>
    							<td>
    								<?php echo $row['dispatched'] == 0 ? 'Yet to Deliver' : 'Delivered'; ?>
    								<button class="btn btn-link p-1" onclick='if(confirm("Do You Want to change delivery Status ?")){location.href="update_replacement_delivery_status.php?id=<?php echo $row['id']; ?>";}'>Change Status</button>
    							</td>
    							<td><?php echo $row['quantity']; ?></td>
    						</tr>
    					<?php } ?>
    				</tbody>
    			</table>
    			
    			
    			
    			<form action="add_item_to_bill.php" class="container card p-3" method="post" id="add_more_item" style="display : none">
    				<datalist id="item_list">
            			<?php while($row = $item_list->fetch_array()){ ?>
    						<option value="<?php echo '['.$row['id'].'] '.$row['name']; ?>"></option>
    					<?php } ?>
            		</datalist>
    				<input type="hidden" name="bill_id" value="<?php echo $id; ?>">
    				<div class="input-group p-3">
        				<input list="item_list" class="form-control w-50" name="item" id="item" placeholder="Enter / Select Item" required>
        				<input type="number" class="form-control w-25" name="quantity" id="quantity" min="1" max="99999" data-parsley-error-message="PLease Enter valid quantity(in range of 1 - 10000)" placeholder="Quantity" required>
        			</div>
        			<div class="container text-center">
        				<input type="submit" value="ADD ITEM" class="btn btn-success">
        			</div>
        		</form>
        		<form action="add_kit_to_bill.php" class="container card p-3" method="post" id="add_more_kit" style="display : none">
    				<datalist id="kit_list">
            			<?php while($row = $kit_list->fetch_array()){ ?>
    						<option value="<?php echo '['.$row['id'].'] '.$row['name']; ?>"></option>
    					<?php } ?>
            		</datalist>
    				<input type="hidden" name="bill_id" value="<?php echo $id; ?>">
    				<div class="input-group p-3">
        				<input list="kit_list" class="form-control w-50" name="kit" id="kit" placeholder="Enter / Select Kit" required>
        				<input type="number" class="form-control w-25" name="quantity" id="quantity" min="1" max="99999" data-parsley-error-message="PLease Enter valid quantity(in range of 1 - 10000)" placeholder="Quantity" required>
        			</div>
        			<div class="container text-center">
        				<input type="submit" value="ADD KIT" class="btn btn-success">
        			</div>
        		</form>
    		</div>
    	</div>
    	<script src="js/bootstrap.bundle.js"></script>
    	<script src="js/font-awesome.js"></script>
    </body>
    <?php include_once 'refuse_connection.php'; ?>
</html> 