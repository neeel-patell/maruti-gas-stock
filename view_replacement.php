<?php
    include 'check_login.php';
    include_once 'connection.php';
    $msg = "";
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    $conn = getConn();
    $replacement = $conn->query("SELECT item_id,SUM(quantity)'quantity' FROM replaced_items GROUP BY item_id");
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
    		<h3 class="text-center">Replacement Stock</h3>
    		<hr class="bg-primary">
    		<div class="table-responsive">
    			<table class="table table-bordered text-center">
    				<thead>
        				<tr>
        					<th>Item</th>
        					<th>Quantity</th>
        					<th>Action</th>
        				</tr>
    				</thead>
    				<tbody>
    					
    					<?php 
            				while($row = $replacement->fetch_array()){
            				    $item_name = $conn->query("SELECT name from item where id=".$row['item_id']);
            				    $item_name = $item_name->fetch_array();
            			        
            		    ?>
    					<tr>
    						<td><?php echo $item_name['name']; ?></td>
    						<td><?php echo $row['quantity']; ?></td>
    						<td>
    							<button class="btn btn-link p-0 text-decoration-none" onclick='if(confirm("Do you want to remove replacement stock from warehouse for <?php echo $item_name['name']; ?> ?")){ location.href="delete_replacement.php?id=<?php echo $row['item_id']; ?>"; }'>Sattle <i class="fas fa-external-link-alt"></i></button>
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