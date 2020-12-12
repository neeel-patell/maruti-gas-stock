<?php
    include 'check_login.php';
    include_once 'connection.php';
    $msg = "";
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    $conn = getConn();
    $suppliers = $conn->query("SELECT id,name,description from item order by name");
    $srno = 1;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <title>View Item</title>
    </head>
    <body>
    	<header class="container-fluid p-4 h4 bg-warning text-black font-monospace m-0" style="min-height: 5vh"><i class="fas fa-car"></i> Maruti Gas Service - Stock Management <i class="fas fa-layer-group"></i></header>
    	
    	<?php include 'navbar.php'; ?>
    	
    	<div class="container-fluid p-4" style="min-height: 92vh">
    		
    		<?php if($msg == "editPass"){ ?>
			<div class="alert alert-success h6 text-center">Item details has been edited !...</div>
			<?php }else if($msg == "editFail"){ ?>
			<div class="alert alert-danger h6 text-center">Item details has not edited !...</div>
			<?php }else if($msg == "delPass"){ ?>
			<div class="alert alert-success h6 text-center">Item details has been deleted !...</div>
			<?php }else if($msg == "delFail"){ ?>
			<div class="alert alert-danger h6 text-center">Item details has not deleted while it's associated with stock exchange !...</div>
			<?php } ?>
    		
    		<h3 class="text-center">Supplier List</h3>
    		<hr class="bg-primary">
    		<div class="table-responsive">
    			<table class="table table-bordered text-center">
    				<thead>
        				<tr>
        					<th>Sr No.</th>
        					<th>Name</th>
        					<th>Description</th>
        					<th>Action</th>
        				</tr>
    				</thead>
    				<tbody>
    					
    					<?php while($row = $suppliers->fetch_array()){ ?>
    					<tr>
    						<td><?php echo $srno++; ?></td>
    						<td><?php echo $row['name']; ?></td>
    						<td><?php if($row['description'] != ""){ echo $row['description']; } else { echo " - "; } ?></td>
    						<td>
    							<button class="btn btn-link p-0 text-decoration-none" onclick='location.href="edit_item.php?id=<?php echo $row['id']; ?>";'>Edit <i class="fas fa-edit"></i></button> |
    							<button class="btn btn-link p-0 text-decoration-none" onclick='if(confirm("Do you want to delete \"<?php echo $row['name']; ?>\" ?")){ location.href="delete_item.php?id=<?php echo $row['id']; ?>";}'>Delete <i class="fas fa-trash-alt"></i></button>
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