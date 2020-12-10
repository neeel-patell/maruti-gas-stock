<?php 
    session_start();
    if(isset($_SESSION['logged_in'])){
        if($_SESSION['logged_in'] != 1){ // checking weather user is logged in or not
            header("location: login.php?msg=la"); // if not logged in then redirecting back to login page
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
        <title>Maruti Gas Stock Management</title>
    </head>
    <body>
    	<header class="container-fluid p-4 h4 bg-warning text-black font-monospace m-0" style="min-height: 5vh"><i class="fas fa-car"></i> Maruti Gas Service - Stock Management <i class="fas fa-layer-group"></i></header>
    	
    	<?php include 'navbar.php'; ?>
    	
    	<div class="container-fluid" style="min-height: 92vh">
    	</div>
    	<script src="js/bootstrap.bundle.js"></script>
    	<script src="js/font-awesome.js"></script>
    </body>
</html>