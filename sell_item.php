<?php
    include 'check_login.php';
    include_once 'connection.php';
    $conn = getConn();
    $msg = "";
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    $item_list = $conn->query("SELECT id,name FROM item ORDER BY name");
    $kit_list = $conn->query("SELECT id,name FROM kit ORDER BY name");
    $customer_list = $conn->query("SELECT id,name,type,mobile from customer order by name");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <title>Sell Item</title>
    </head>
    <body>
    	<header class="container-fluid p-4 h4 bg-warning text-black font-monospace m-0" style="min-height: 5vh"><i class="fas fa-car"></i> New Maruti Auto Gas <i class="fas fa-layer-group"></i></header>
    	
    	<?php include 'navbar.php'; ?>
    	
    	<div class="container-fluid row mt-5" style="min-height: 92vh">
    		<div class="col-sm-3"></div>
    		<form action="insert_bill.php" method="post" class="col-sm-6" data-parsley-validate>
    			<div class="card p-3">
    				<h4 class="text-center mb-3">Bill Details</h4>
    				
    				<?php if($msg == "pass"){ ?>
    				<div class="alert alert-success h6 text-center">Item details has been saved !...</div>
    				<?php }else if($msg == "fail"){ ?>
    				<div class="alert alert-danger h6 text-center">Item details has not saved !...</div>
    				<?php } ?>
    				
    				<datalist id="customer_list">
    					<?php while($row = $customer_list->fetch_array()){ ?>
        					<option value="[<?php echo $row['id']; ?>] <?php echo $row['name']; ?>">
        						<?php
        						  if($row['type'] == 0){ 
        						      echo "Retail";
        						  }
        						  else if($row['type'] == 1){
        						      echo "Wholeseller";
        						  }
        						  else{
        						      echo "Fitman";
        						  }
        						  echo " ".$row['mobile'];
        						?>
        					</option>
        				<?php } ?>
    				</datalist>
    				
    				<datalist id="item_list">
            			<?php while($row = $item_list->fetch_array()){ ?>
    						<option value="<?php echo '['.$row['id'].'] '.$row['name']; ?>"></option>
    					<?php } ?>
            		</datalist>
            		
            		<datalist id="kit_list">
            			<?php while($row = $kit_list->fetch_array()){ ?>
    						<option value="<?php echo '['.$row['id'].'] '.$row['name']; ?>"></option>
    					<?php } ?>
            		</datalist>
    				
    				<hr class="bg-primary" size="5px">
        			<div class="form-group p-1">
        				<label>Customer Name : </label>
        				<input type="text" list="customer_list" name="customer_name" id="customer_name" class="form-control mt-1" placeholder="Enter/Select Customer Name" required>
        			</div>
        			<div class="form-group p-1 mb-5">
            				<label>Date : </label>
            				<input type="date" class="form-control" name="bill_date" id="bill_date">
            			</div>
        			<div class="card p-2">
        				<h6>Item/Kit details</h6>
        				<div id="items_div">
            				
            			</div>
            			<hr>
            			<div id="kits_div">
            				
            			</div>
            			
            			<div>
            				<button type="button" class="btn btn-outline-primary mt-2" onclick="add_item()"><i class="fas fa-plus"></i> Add Item</button> &nbsp; &nbsp;  
            				<button type="button" class="btn btn-outline-primary mt-2" onclick="add_kit()"><i class="fas fa-plus"></i> Add kit</button>
            			</div>
        			</div>
        			<div class="container p-3 text-center">
        				<button class="btn btn-success text-uppercase" type="submit">Generate Bill <i class="fas fa-file-invoice-dollar"></i></button>
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
    		var i = 1;
    		function add_item(){
    			var items_div = document.getElementById('items_div');
    			
    			var input_group = document.createElement('div');
    			input_group.setAttribute('class','input-group p-1');
    			
    			items_div.appendChild(input_group);
    			var temp =  '<input list="item_list" class="form-control w-50" name="item'+i+'" id="item'+i+'" placeholder="Enter / Select Item" required>'+
                			'<input type="number" class="form-control w-25" name="item_quantity'+i+'" id="quantity'+i+'" min="1" max="99999" data-parsley-error-message="PLease Enter valid quantity(in range of 1 - 10000)" placeholder="Quantity" required>';
                i = i + 1;
                input_group.innerHTML = temp;
    		}
    		j = 1;
    		function add_kit(){
    			var kits_div = document.getElementById('kits_div');
    			
    			var input_group = document.createElement('div');
    			input_group.setAttribute('class','input-group p-1');
    			
    			kits_div.appendChild(input_group);
    			var temp =  '<input list="kit_list" class="form-control w-50" name="kit'+j+'" id="kit'+j+'" placeholder="Enter / Select Kit" required>'+
                			'<input type="number" class="form-control w-25" name="kit_quantity'+j+'" id="kit_quantity'+j+'" min="1" max="99999" data-parsley-error-message="PLease Enter valid quantity(in range of 1 - 10000)" placeholder="Quantity" required>';
                j = j + 1;
                input_group.innerHTML = temp;
    		}
    		var n =  new Date();
            var y = n.getFullYear();
            var m = n.getMonth() + 1;
            var d = n.getDate();
            document.getElementById("bill_date").value = y+"-"+m+"-"+d;
    	</script>
    </body>
</html>