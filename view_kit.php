<?php
    include 'check_login.php';
    include_once 'connection.php';
    $msg = "";
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    $conn = getConn();
    $kit = $conn->query("SELECT id,name from kit order by name");
    $srno = 1;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <title>View Kit</title>
    </head>
    <body>
    	<header class="container-fluid p-4 h4 bg-warning text-black font-monospace m-0" style="min-height: 5vh"><i class="fas fa-car"></i> New Maruti Auto Gas <i class="fas fa-layer-group"></i></header>
    	
    	<?php include 'navbar.php'; ?>
    	
    	<div class="container-fluid p-4" style="min-height: 92vh">
    		
    		<?php if($msg == "delPass"){ ?>
			<div class="alert alert-success h6 text-center">Kit has been edited !...</div>
			<?php }else if($msg == "delFail"){ ?>
			<div class="alert alert-danger h6 text-center">Kit is associated with stocks exchange ant it can't be deleted !...</div>
			<?php } ?>
    		
    		<h3 class="text-center">Kit List</h3>
    		<hr class="bg-primary">
    		<div class="table-responsive">
    			<table class="table table-bordered text-center">
    				<thead>
        				<tr>
        					<th>Sr No.</th>
        					<th>Name</th>
        					<th>Action</th>
        				</tr>
    				</thead>
    				<tbody>
    					
    					<?php while($row = $kit->fetch_array()){ ?>
    					<tr>
    						<td><?php echo $srno++; ?></td>
    						<td><?php echo $row['name']; ?></td>
    						<td>
    							<button class="btn btn-link p-0 text-decoration-none" onclick='location.href="view_kit_item.php?id=<?php echo $row['id']; ?>";'>View Items <i class="far fa-eye"></i></button> |
    							<button class="btn btn-link p-0 text-decoration-none" onclick='if(confirm("Do you want to delete <?php echo $row['name']; ?>?")){ location.href="delete_kit.php?id=<?php echo $row['id']; ?>";}'>Delete <i class="fas fa-trash-alt"></i></button>
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