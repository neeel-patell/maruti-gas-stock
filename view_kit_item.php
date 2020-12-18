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
        header('location: view_kit.php');
    }
    $conn = getConn();
    $kit = $conn->query("SELECT name from kit where id=$id");
    $kit = $kit->fetch_array();
    
    $kit_items = $conn->query("SELECT id,item_id,quantity from kit_items where kit_id=$id");
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
    	
    		<?php if($msg == "delPass"){ ?>
			<div class="alert alert-success h6 text-center">Item is removed from current kit !...</div>
			<?php }else if($msg == "delFail"){ ?>
			<div class="alert alert-danger h6 text-center">Something wen wrong while removing Item !...</div>
			<?php }else if($msg == "itemAdded"){ ?>
			<div class="alert alert-success h6 text-center">Item is Successfully added in a kit !...</div>
			<?php }else if($msg == "itemAddFail"){ ?>
			<div class="alert alert-danger h6 text-center">Item is not added, please try again !...</div>
			<?php } ?>
    		
    		<h3 class="text-center">[<?php echo $kit['name']; ?>]'s kit	 Details</h3>
    		<hr class="bg-primary mb-3">
    		<div class="table-responsive">
    			<table class="table table-bordered text-center">
    				<thead>
        				<tr>
        					<th>Sr No.</th>
        					<th>Item Name</th>
        					<th>Quantity</th>
        				</tr>
    				</thead>
    				<tbody>
    					
    					<?php 
            				while($row = $kit_items->fetch_array()){
            			        $item_name = $conn->query("SELECT name from item where id=".$row['item_id']);
            			        $item_name = $item_name->fetch_array();
            		    ?>
            		    
    					<tr>
    						<td><?php echo $srno++; ?></td>
    						<td><?php echo $item_name['name']; ?></td>
    						<td><?php echo $row['quantity']; ?></td>
    						<td style="width: 180px;">
    							<button class="btn btn-link p-0 text-decoration-none" onclick='if(confirm("Do you want to remove item ? ")){ location.href="delete_kit_item.php?id=<?php echo $row['id']; ?>&kit=<?php echo $id; ?>"; }'><i class="fas fa-minus-circle"></i> Remove Item</button>
    						</td>
    					</tr>
    					<?php } ?>
    					
    				</tbody>
    				<tfoot>
    					<tr>
    						<td colspan="5" class="text-center">
    							<button class="btn btn-success" onclick="document.getElementById('add_more').style.display ='block'"><i class="fas fa-plus-square"></i> Add Item to Kit</button>
    							<button class="btn btn-danger" onclick='if(confirm("Are you sure for deleting this entry?")){ location.href="delete_kit.php?id=<?php echo $id; ?>"; }'><i class="fas fa-trash"></i> Delete Kit</button>
    						</td>
    					</tr>
    				</tfoot>
    			</table>
    			<form action="add_to_kit.php" class="container card p-3" method="post" id="add_more" style="display : none">
    				<datalist id="item_list">
            			<?php while($row = $item_list->fetch_array()){ ?>
    						<option value="<?php echo '['.$row['id'].'] '.$row['name']; ?>"></option>
    					<?php } ?>
            		</datalist>
    				<input type="hidden" name="kit_id" value="<?php echo $id; ?>">
    				<div class="input-group p-3">
        				<input list="item_list" class="form-control w-50" name="item" id="item" placeholder="Enter / Select Item" required>
        				<input type="number" class="form-control w-25" name="quantity" id="quantity" min="1" max="99999" data-parsley-error-message="PLease Enter valid quantity(in range of 1 - 10000)" placeholder="Quantity" required>
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