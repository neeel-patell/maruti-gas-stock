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
    
    $items = array();
    
    $customer = $conn->query("SELECT name,type FROM customer where id=".$bill['customer_id']);
    $customer = $customer->fetch_array();
    
    $kit_list = $conn->query("SELECT kit_id,quantity FROM bill_kit WHERE bill_id=$id");
    
    while($row = $kit_list->fetch_array()){
        $quantity = $row['quantity'];
        $kit_items = $conn->query("SELECT item_id,(quantity*$quantity)'quantity' FROM kit_items WHERE kit_id=".$row['kit_id']);
        while($row1 = $kit_items->fetch_array()){
            if(isset($items[$row1['item_id']])){
                $items[$row1['item_id']] += $row1['quantity'];
            }
            else{
                $items[$row1['item_id']] = $row1['quantity'];
            }
        }
    }
    
    $item_list = $conn->query("SELECT item_id,quantity FROM bill_item WHERE bill_id=$id");
    
    while($row = $item_list->fetch_array()){
        if(isset($items[$row['item_id']])){
            $items[$row['item_id']] += $row['quantity'];
        }
        else{
            $items[$row['item_id']] = $row['quantity'];
        }
    }
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
    		
    		<div class="table-responsive mt-3">
    			<table class="table table-bordered">
    				<thead>
    					<tr>
    						<th>Sr No.</th>
    						<th>Item Name</th>
    						<th>Total Item</th>
    						<th>Quantity</th>
    					</tr>
    				</thead>
    				<tbody>
    					
    					<?php
    					   $sr_no = 1;
    					   foreach($items as $key=>$value){ 
    					       $item_name = $conn->query("SELECT name from item WHERE id=$key");
    					       $item_name = $item_name->fetch_array();
    					?>
    					
    						<tr>
    							<td><?php echo $sr_no++; ?></td>
    							<td><?php echo $item_name['name']; ?></td>
    							<td><?php echo $value; ?></td>
    							<td style="width : 500px;">
    								<form class="form-inline" action="insert_replacement.php" method="post">
    									<input type="hidden" name="bill_id" value="<?php echo $id; ?>">
    									<input type="hidden" name="item_id" value="<?php echo $key; ?>">
    									<div class="input-group">
    										<input class="form-control" name="quantity" type="number" min="0" max="<?php echo $value; ?>" required>
    										<input class="btn btn-danger" type="submit" value="Replace">
    									</div>
    								</form>
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