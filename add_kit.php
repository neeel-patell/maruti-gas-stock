<?php
    include 'check_login.php';
    include_once 'connection.php';
    $conn = getConn();
    $msg = "";
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    $item = $conn->query("SELECT id,name FROM item ORDER BY name");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <title>Make a kit</title>
    </head>
    <body>
    	<header class="container-fluid p-4 h4 bg-warning text-black font-monospace m-0" style="min-height: 5vh"><i class="fas fa-car"></i> Maruti Gas Service - Stock Management <i class="fas fa-layer-group"></i></header>
    	
    	<?php include 'navbar.php'; ?>
    	
    	<div class="container-fluid row mt-5" style="min-height: 92vh">
    		<div class="col-sm-3"></div>
    		<form action="insert_kit.php" method="post" class="col-sm-6" data-parsley-validate>
    			<datalist id="item_list">
        			<?php while($row = $item->fetch_array()){ ?>
						<option value="<?php echo '['.$row['id'].'] '.$row['name']; ?>"></option>
					<?php } ?>
        		</datalist>
    			<div class="card p-3">
    				<h4 class="text-center mb-3">New Kit Details</h4>
    				
    				<?php if($msg == "pass"){ ?>
    				<div class="alert alert-success h6 text-center">Kit details has been saved !...</div>
    				<?php }else if($msg == "fail"){ ?>
    				<div class="alert alert-danger h6 text-center">Kit details has not saved !...</div>
    				<?php } ?>
    				
    				<hr class="bg-primary" size="5px">
        			<div class="form-group p-3">
        				<label>Kit Name : </label>
        				<input type="text" maxlength="50" name="name" id="name" class="form-control mt-1" placeholder="Enter Kit Name" required>
        			</div>
        			<div class="card p-2">
						<h6>Item details</h6>    
						<div id="items_div">
            				<div class="input-group p-3">
                				<input list="item_list" class="form-control w-50" name="item1" id="item1" placeholder="Enter / Select Item" required>
                				<input type="number" class="form-control w-25" name="quantity1" id="quantity1" min="1" max="99999" data-parsley-error-message="PLease Enter valid quantity(in range of 1 - 10000)" placeholder="Quantity" required>
                			</div>
            			</div>
            			<div>
            				<button type="button" class="btn btn-outline-primary" onclick="add_item()"><i class="fas fa-plus"></i> Add Item</button>
            			</div>
        			</div>
        			<div class="container p-3 text-center">
        				<button class="btn btn-success text-uppercase" type="submit">Add new Kit <i class="fas fa-link"></i></button>
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
    			input_group.setAttribute('class','input-group p-3');
    			
    			items_div.appendChild(input_group);
    			var temp =  '<input list="item_list" class="form-control w-50" name="item'+i+'" id="item'+i+'" placeholder="Enter / Select Item" required>'+
                			'<input type="number" class="form-control w-25" name="quantity'+i+'" id="quantity'+i+'" min="1" max="99999" data-parsley-error-message="PLease Enter valid quantity(in range of 1 - 10000)" placeholder="Quantity" required>';
                			
                i = i + 1;
                input_group.innerHTML = temp;
    		}
    	</script>
    </body>
</html>