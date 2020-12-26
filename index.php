<?php
    include 'check_login.php';
    include_once 'connection.php';
    $conn = getConn();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <title>Dashboard</title>
    </head>
    <body>
    	<header class="container-fluid p-4 h4 bg-warning text-black font-monospace m-0" style="min-height: 5vh"><i class="fas fa-car"></i> New Maruti Auto Gas <i class="fas fa-layer-group"></i></header>
    	
    	<?php include 'navbar.php'; ?>
    	
    	<div class="row m-0 mt-5 p-3">
    		<div class="col-4 p-2 text-center">
    			
    			<?php 
				      $item_quantity = $conn->query("SELECT count(id)'quantity' FROM item where current_stock<50");
				      $item_quantity = $item_quantity->fetch_array();
				?>
    			
    			<div class="card p-4 border-3 <?php if($item_quantity['quantity'] > 0) echo "text-danger"; else echo "text-primary" ?>" onclick='location.href="view_item.php";'>
        			<h3 class="mt-3">
        				<?php echo $item_quantity['quantity']; ?>
        			</h3>
        			<hr>
    				<h4 class="mb-3">ITEM UNDER MINIMUM QUANTITY</h4>
    			</div>
    		</div>
    		
    		<div class="col-4 p-2 text-center">
    			
    			<?php 
				      $wholeseller_array = array();
				      $wholeseller = $conn->query("SELECT id from customer WHERE type=1");
				      $wholeseller_string = "";
				      while($row = $wholeseller->fetch_array()){
				          array_push($wholeseller_array,$row['id']);
				      }
				      foreach($wholeseller_array as $value){
				          $wholeseller_string .= $value.",";
				      }
				      $wholeseller_string[-1] = " ";
				      $bills = $conn->query("SELECT id FROM bill where customer_id IN($wholeseller_string)");
				      $bills_array = $bills->fetch_all();
				      $bills_string = "";
				      $bill_count = 0;
				      foreach($bills_array as $key=>$value){
				          $bill_count++;
				          $bills_string .= $bills_array[$key][0].",";
				      }
				      $bills_string[-1] = " ";
				      $bill_transporter = $conn->query("SELECT count(id)'quantity' FROM bill_transporter");
				      $bill_transporter = $bill_transporter->fetch_array();
				      $diff = $bill_count - $bill_transporter['quantity'];
				?>
    			
    			<div class="card p-4 border-3 <?php if($diff > 0) echo "text-danger"; else echo "text-primary"; ?>" onclick='location.href="view_undispatched_bill.php";'>
    				<h3 class="mt-3">
        				<?php echo $diff; ?>
        			</h3>
        			<hr>
    				<h4 class="mb-3?>">BILLS WITH PENDING DEIVERIES</h4>
    			</div>
    		</div>
    		
    	</div>
    	
    	<div class="container-fluid" style="min-height: 92vh">
    	</div>
    	<script src="js/bootstrap.bundle.js"></script>
    	<script src="js/font-awesome.js"></script>
    </body>
</html>
<?php include_once 'refuse_connection.php'; ?>