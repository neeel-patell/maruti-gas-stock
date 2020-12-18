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
    $incoming_stock = $conn->query("SELECT supplier_id,date_time from incoming_stock where id=$id");
    $incoming_stock = $incoming_stock->fetch_array();
    
    $supplier_name = $conn->query("SELECT name FROM supplier where id=".$incoming_stock['supplier_id']);
    $supplier_name = $supplier_name->fetch_array();
    
    $incoming_stock_items = $conn->query("SELECT id,item_id,quantity,price from incoming_stock_item where incoming_stock_id=$id");
    $srno = 1;
    
    $item_list = $conn->query("SELECT id,name FROM item ORDER BY name");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <title>View Supplier</title>
    </head>
    <body>
    	<header class="container-fluid p-4 h4 bg-warning text-black font-monospace m-0" style="min-height: 5vh"><i class="fas fa-car"></i> Maruti Gas Service - Stock Management <i class="fas fa-layer-group"></i></header>
    	
    	<?php include 'navbar.php'; ?>
    	
    	<div class="container-fluid p-4" style="min-height: 92vh">
    	
    		<?php if($msg == "delItem"){ ?>
			<div class="alert alert-success h6 text-center">Item is removed from current lot !...</div>
			<?php }else if($msg == "delItemFail"){ ?>
			<div class="alert alert-danger h6 text-center">Something wen wrong while removing Item !...</div>
			<?php }else if($msg == "itemAdded"){ ?>
			<div class="alert alert-success h6 text-center">Item is Successfully added in a lot !...</div>
			<?php }else if($msg == "itemAddFail"){ ?>
			<div class="alert alert-danger h6 text-center">Item is not added, please try again !...</div>
			<?php } ?>
    		
    		<h3 class="text-center">[<?php echo $supplier_name['name']; ?>]'s Item Details</h3>
    		<h5 class="text-end">Date : <?php echo date_format(date_create($incoming_stock['date_time']), 'd M Y'); ?></h5>
    		<hr class="bg-primary mb-3">
    		<div class="table-responsive">
    			<table class="table table-bordered text-center">
    				<thead>
        				<tr>
        					<th>Sr No.</th>
        					<th>Item Name</th>
        					<th>Quantity</th>
        					<th>Price</th>
        					<th>Total</th>
        				</tr>
    				</thead>
    				<tbody>
    					
    					<?php 
            				while($row = $incoming_stock_items->fetch_array()){
            			        $item_name = $conn->query("SELECT name from item where id=".$row['item_id']);
            			        $item_name = $item_name->fetch_array();
            		    ?>
            		    
    					<tr>
    						<td><?php echo $srno++; ?></td>
    						<td><?php echo $item_name['name']; ?></td>
    						<td><?php echo $row['quantity']; ?></td>
    						<td><?php echo $row['price']; ?></td>
    						<td><?php echo $row['quantity'] * $row['price']; ?></td>
    						<td style="width: 180px;">
    							<button class="btn btn-link p-0 text-decoration-none" onclick='if(confirm("Do you want to remove item ? ")){ location.href="delete_stock_item.php?id=<?php echo $row['id']; ?>"; }'><i class="fas fa-minus-circle"></i> Remove Item</button>
    						</td>
    					</tr>
    					<?php } ?>
    					
    				</tbody>
    				<tfoot>
    					<tr>
    						<td colspan="5" class="text-center">
    							<button class="btn btn-success" onclick="document.getElementById('add_more').style.display ='block'"><i class="fas fa-plus-square"></i> Add Item</button>
    							<button class="btn btn-danger" onclick='if(confirm("Are you sure for deleting this entry?")){ location.href="delete_incoming_stock.php?id=<?php echo $id; ?>"; }'><i class="fas fa-trash"></i> Delete Stock Entry</button>
    						</td>
    					</tr>
    				</tfoot>
    			</table>
    			<form action="add_to_stock.php" class="container card p-3" method="post" id="add_more" style="display : none">
    				<datalist id="item_list">
            			<?php while($row = $item_list->fetch_array()){ ?>
    						<option value="<?php echo '['.$row['id'].'] '.$row['name']; ?>"></option>
    					<?php } ?>
            		</datalist>
    				<input type="hidden" name="incoming_id" value="<?php echo $id; ?>">
    				<div class="input-group p-3">
        				<input list="item_list" class="form-control w-50" name="item" id="item" placeholder="Enter / Select Item" required>
        				<input type="number" class="form-control w-25" name="quantity" id="quantity" min="1" max="99999" data-parsley-error-message="PLease Enter valid quantity(in range of 1 - 10000)" placeholder="Quantity" required>
        				<input type="text" class="form-control w-25" name="price" id="price" placeholder="Price" maxlength="9" data-parsley-error-message="PLease Enter valid price amount" data-parsley-type="number" required>
        			</div>
        			<div class="container text-center">
        				<input type="submit" value="ADD ITEM" class="btn btn-success">
        			</div>
        		</form>
    		</div>
    	</div>
    	<script src="js/bootstrap.bundle.js"></script>
    	<script src="js/font-awesome.js"></script>
    </body>
    <?php include_once 'refuse_connection.php'; ?>
</html>