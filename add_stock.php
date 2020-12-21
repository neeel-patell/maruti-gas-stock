<?php
    include 'check_login.php';
    include_once 'connection.php';
    $conn = getConn();
    $msg = "";
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    $supplier = $conn->query("SELECT id,name FROM supplier ORDER BY name");
    $item = $conn->query("SELECT id,name FROM item ORDER BY name");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <title>Add Stock</title>
    </head>
    <body>
    	<header class="container-fluid p-4 h4 bg-warning text-black font-monospace m-0" style="min-height: 5vh"><i class="fas fa-car"></i> New Maruti Auto Gas <i class="fas fa-layer-group"></i></header>
    	
    	<?php include 'navbar.php'; ?>
    	
    	<div class="container-fluid row mt-5" style="min-height: 92vh">
    		<div class="col-sm-3"></div>
    		<form action="insert_stock.php" method="post" class="col-sm-6" data-parsley-validate>
    			<div class="card p-3">
    				<h4 class="text-center mb-3">Incoming Stock Details</h4>
    				
    				<?php if($msg == "pass"){ ?>
    				<div class="alert alert-success h6 text-center">Item details has been saved !...</div>
    				<?php }else if($msg == "fail"){ ?>
    				<div class="alert alert-danger h6 text-center">Incoming Stock details has not saved, Please try again !...</div>
    				<?php } ?>
    				
    				<hr class="bg-primary" size="5px">
        			<div class="card p-3">
        				<h6>Supplier Details</h6>
        				<div class="form-group p-1">
            				<label>Select Supplier : </label>
            				<input list="supplier_list" name="supplier" id="supplier" class="form-control" placeholder="Enter / Select Supplier" required>
            				<datalist id="supplier_list">
            					
            					<?php while($row = $supplier->fetch_array()){ ?>
            						<option value="<?php echo '['.$row['id'].'] '.$row['name']; ?>"></option>
            					<?php } ?>
            					
            				</datalist>
            			</div>
            			<div class="form-group p-1">
            				<label>Date : </label>
            				<input type="date" class="form-control" name="stock_date" id="stock_date">
            			</div>
            		</div>
            		<datalist id="item_list">
            			<?php while($row = $item->fetch_array()){ ?>
    						<option value="<?php echo '['.$row['id'].'] '.$row['name']; ?>"></option>
    					<?php } ?>
            		</datalist>
            		<div class="card p-3 mt-5">
            			<h6>Incoming Item Details</h6>
                		<div id="items_div">
            				<div class="input-group p-1">
                				<input list="item_list" class="form-control w-50" name="item1" id="item1" placeholder="Enter / Select Item" required>
                				<input type="number" class="form-control w-25" name="quantity1" id="quantity1" min="1" max="99999" data-parsley-error-message="PLease Enter valid quantity(in range of 1 - 10000)" placeholder="Quantity" required>
                			</div>
            			</div>
            			<div>
            				<button type="button" class="btn btn-outline-primary mt-2" onclick="add_item()"><i class="fas fa-plus"></i> Add Item</button>
            			</div>
        			</div>
        			<div class="container p-3 text-center">
        				<button class="btn btn-success text-uppercase" type="submit">Add to stock <i class="fab fa-stack-overflow"></i></button>
        			</div>
    			</div>
    		</form>
    		<div class="col-sm-3"></div>
    	</div>
    	<script src="js/bootstrap.bundle.js"></script>
    	<script src="js/jquery.js"></script>
    	<script src="js/parsley.js"></script>
    	<script src="js/font-awesome.js"></script>
    	<script type="text/javascript">
    		var i = 2;
    		function add_item(){
    			var items_div = document.getElementById('items_div');
    			
    			var input_group = document.createElement('div');
    			input_group.setAttribute('class','input-group p-1');
    			
    			items_div.appendChild(input_group);
    			var temp =  '<input list="item_list" class="form-control w-50" name="item'+i+'" id="item'+i+'" placeholder="Enter / Select Item" required>'+
                			'<input type="number" class="form-control w-25" name="quantity'+i+'" id="quantity'+i+'" min="1" max="99999" data-parsley-error-message="PLease Enter valid quantity(in range of 1 - 10000)" placeholder="Quantity" required>';
                i = i + 1;
                input_group.innerHTML = temp;
    		}
    	</script>
    </body>
    <?php require_once 'refuse_connection.php'; ?>
</html>