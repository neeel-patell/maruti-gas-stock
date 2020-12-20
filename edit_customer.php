<?php
    include 'check_login.php';
    include_once 'connection.php';
    if(!isset($_GET['id'])){
        header("location: view_item.php");
    }
    $id = $_GET['id'];
    $conn = getConn();
    $customer = $conn->query("SELECT name,mobile,email from customer where id=$id");
    $customer = $customer->fetch_array();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <title>Edit Customer</title>
    </head>
    <body>
    	<header class="container-fluid p-4 h4 bg-warning text-black font-monospace m-0" style="min-height: 5vh"><i class="fas fa-car"></i> New Maruti Auto Gas <i class="fas fa-layer-group"></i></header>
    	
    	<?php include 'navbar.php'; ?>
    	
    	<div class="container-fluid row mt-5" style="min-height: 92vh">
    		<div class="col-sm-3"></div>
    		<form action="update_customer.php" method="post" class="col-sm-6" data-parsley-validate>
    			<input type="hidden" name="id" value="<?php echo $id; ?>">
    			<div class="card p-3">
    				<h4 class="text-center mb-3">Edit Customer Details</h4>
    				
    				<hr class="bg-primary" size="5px">
        			<div class="form-group p-1">
        				<label>Name : </label>
        				<input type="text" value="<?php echo $customer['name']; ?>" maxlength="50" name="name" id="name" class="form-control mt-1" placeholder="Enter First Name" required>
        			</div>
        			<div class="form-group p-1">
        				<label>Mobile : </label>
        				<input type="text" value="<?php echo $customer['mobile']; ?>" maxlength="10" minlength="10" name="mobile" id="mobile" class="form-control mt-1" data-parsley-type="digits" placeholder="Enter Contact Number" required>
        			</div>
        			<div class="form-group p-1">
        				<label>Email : </label>
        				<input type="email" value="<?php echo $customer['email']; ?>" maxlength="256" name="email" id="email" class="form-control mt-1" placeholder="Enter Email address (Optional)">
        			</div>
        			<div class="container p-3 text-center">
        				<button class="btn btn-success text-uppercase" type="submit">Edit Customer <i class="fas fa-pencil-alt"></i></button>
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
</html>