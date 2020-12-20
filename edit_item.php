<?php
    include 'check_login.php';
    include_once 'connection.php';
    if(!isset($_GET['id'])){
        header("location: view_item.php");
    }
    $id = $_GET['id'];
    $conn = getConn();
    $item = $conn->query("SELECT id,name,description from item where id=$id");
    $item = $item->fetch_array();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <title>Edit Item</title>
    </head>
    <body>
    	<header class="container-fluid p-4 h4 bg-warning text-black font-monospace m-0" style="min-height: 5vh"><i class="fas fa-car"></i> New Maruti Auto Gas <i class="fas fa-layer-group"></i></header>
    	
    	<?php include 'navbar.php'; ?>
    	
    	<div class="container-fluid row mt-5" style="min-height: 92vh">
    		<div class="col-sm-3"></div>
    		<form action="update_item.php" method="post" class="col-sm-6" data-parsley-validate>
    			<input type="hidden" name="id" value="<?php echo $item['id']; ?>">
    			<div class="card p-3">
    				<h4 class="text-center mb-3">Edit Item Details</h4>
    				<hr class="bg-primary" size="5px">
        			<div class="form-group p-1">
        				<label>Item Name : </label>
        				<input type="text" maxlength="50" name="name" id="name" value="<?php echo $item['name']; ?>" class="form-control mt-1" placeholder="Enter Item Name" required>
        			</div>
        			<div class="form-group p-1">
        				<label>Description : </label>
        				<input type="text" maxlength="150" name="description" id="description" value='<?php echo $item['description']; ?>' class="form-control mt-1" placeholder="Enter item description (optional)">
        			</div>
        			
        			<div class="container p-3 text-center">
        				<button class="btn btn-success text-uppercase" type="submit">Edit Details <i class="fas fa-edit"></i></button>
        			</div>
    			</div>
    		</form>
    		<div class="col-sm-3"></div>
    	</div>
    	<script src="js/bootstrap.bundle.js"></script>
    	<script src="js/jquery.js"></script>
    	<script src="js/parsley.js"></script>
    	<script src="js/font-awesome.js"></script>
    </body>
    <?php include_once 'refuse_connection.php'; ?>
</html>