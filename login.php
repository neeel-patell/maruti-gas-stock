<?php 
    session_start();
    $_SESSION['logged_in'] = 0;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <title>User Login</title>
    </head>
    <body>
    	<header class="container-fluid p-4 h4 bg-warning text-black font-monospace m-0" style="min-height: 5vh"><i class="fas fa-car"></i> New Maruti Auto Gas <i class="fas fa-layer-group"></i></header>
    	<div class="container-fluid" style="min-height: 95vh">
    		<div class="row">
    			<div class="col-sm-3"></div>
    			<div class="col-sm-6">
    				<div class="card border-dark mt-5">
     					<div class="card-header h3 p-3 text-center bg-primary text-white font-monospace">Login <i class="fas fa-key"></i></div>
    					<div class="p-5 pt-2 mt-3 container text-center">
    						
    						<?php if(isset($_GET['msg'])){ if($_GET['msg'] === "lf"){ ?>
            				    <div class="alert alert-danger h6">Wrong Username or Password !... </div>
            				<?php } ?>
            				<?php if($_GET['msg'] === "la"){ ?>
            				    <div class="alert alert-danger h6">Please Login Again !!!  ... </div>
            				<?php }} ?>
        				
    						<form action="user_login.php" method="post" class="mt-3 mb-3 p-3">
    							<input class="form-control mt-2 mb-3 text-center" name="username" id="username" placeholder="Enter Username" type="email" maxlength="256" />
    							<input class="form-control mt-2 mb-3 text-center" name="password" id="password" placeholder="Enter Password" type="password" maxlength="256" />
    							<button class="btn btn-success" type="submit"><span class="p-2 h5">Sign In <i class="fas fa-sign-in-alt"></i></span></button>
    						</form>
    					</div>
    				</div>
    			</div>
    			<div class="col-sm-3"></div>
    		</div>
    	</div>
    	<script src="js/bootstrap.bundle.js"></script>
    	<script src="js/font-awesome.js"></script>
    </body>
</html>