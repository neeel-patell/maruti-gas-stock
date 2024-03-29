<?php
    include 'check_login.php';
    include_once 'connection.php';
    $msg = $search = $type = "";
    if(isset($_GET['msg'])){
        $msg = $_GET['msg'];
    }
    if(isset($_GET['search'])){
        $search = $_GET['search'];
    }
    if(isset($_GET['type'])){
        if($_GET['type'] == "wholesell")
            $type = 1;
        else if($_GET['type'] == "retail")
            $type = 0;
        else if($_GET['type'] == "fitman")
                $type = 2;
        else
            $type = $_GET['type'];
    }
    $conn = getConn();
    $query = "SELECT id,name,mobile,email from customer";
    if($search !== "" AND $type !== ""){
        if(is_numeric($search)){
            $query .= " where mobile like '%$search%'";
        }
        else{
            $query .= " where (name like '%$search%' or email like '%$search%')";
        }
        $query .= " AND `type` = $type";
    }
    else if($search !== ""){
        if(is_numeric($search)){
            $query .= " where mobile like '%$search%'";
        }
        else{
            $query .= " where name like '%$search%' or email like '%$search%'";
        }
    }
    else if($type !== ""){
        $query .= " where `type` = $type";
    }
    $query .= " order by name";
    $customer = $conn->query($query);
    $srno = 1;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="UTF-8">
        <title>View Customer</title>
    </head>
    <body>
    	<header class="container-fluid p-4 h4 bg-warning text-black font-monospace m-0" style="min-height: 5vh"><i class="fas fa-car"></i> New Maruti Auto Gas <i class="fas fa-layer-group"></i></header>
    	
    	<?php include 'navbar.php'; ?>
    	
    	<div class="container-fluid p-4" style="min-height: 92vh">
    		
    		<?php if($msg == "editPass"){ ?>
			<div class="alert alert-success h6 text-center">Customer details has been edited !...</div>
			<?php }else if($msg == "editFail"){ ?>
			<div class="alert alert-danger h6 text-center">Customer details has not edited !...</div>
			<?php }else if($msg == "delPass"){ ?>
			<div class="alert alert-success h6 text-center">Customer details has been deleted !...</div>
			<?php }else if($msg == "delFail"){ ?>
			<div class="alert alert-danger h6 text-center">Customer details has not deleted while it's associated with stock exchange !...</div>
			<?php } ?>
    		
    		<h3 class="text-center">
    		<?php
        		if($type == 0){
        		    echo "Retail Customer";
        		}
        		else if($type == 1){
        		    echo "Wholeseller";
        		}
        		if($type == 2){
        		    echo "Fitman";
        		}
    		?>
    		List</h3>
    		<div class="row">
    			<div class="col-sm-4">
    				<select class="form-select" id="cust_type" onchange='location.href = "view_customer.php?search=<?php echo $search; ?>&type="+document.getElementById("cust_type").value'>		
    					<option value="">- - - All Customers - - -</option>
    					<option value="retail" <?php if($type === 0){ echo "selected"; } ?> >Retail</option>
    					<option value="wholesell" <?php if($type == 1){ echo "selected"; } ?> >Wholesell</option>
    					<option value="fitman" <?php if($type == 2){ echo "selected"; } ?> >Fitman</option>
    				</select>
    			</div>
    			<div class="col-sm-2"></div>
    			<div class="col-sm-2"></div>
    			<div class="col-sm-4">
    				<div class="input-group">
    					<input class="form-control" id="search_text" <?php if($search !== ""){ echo 'value ="'.$search.'"'; } ?> type="search" placeholder="Type here to search">
    					<button class="btn btn-dark" onclick='location.href="view_customer.php?type=<?php echo $type; ?>&search="+document.getElementById("search_text").value'><i class="fas fa-search"></i> Search</button>
    				</div>
    			</div>
    		</div>
    		<hr class="bg-primary">
    		<div class="table-responsive">
    			<table class="table table-bordered text-center">
    				<thead>
        				<tr>
        					<th>Sr No.</th>
        					<th>Name</th>
        					<th>Mobile</th>
        					<th>Email</th>
        					<th>Action</th>
        				</tr>
    				</thead>
    				<tbody>
    					
    					<?php while($row = $customer->fetch_array()){ ?>
    					<tr>
    						<td><?php echo $srno++; ?></td>
    						<td><a href="view_customer_bill.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></td>
    						<td><?php echo $row['mobile']; ?></td>
    						<td><?php echo $row['email']; ?></td>
    						<td>
    							<button class="btn btn-link p-0 text-decoration-none" onclick='location.href="edit_customer.php?id=<?php echo $row['id']; ?>";'>Edit <i class="fas fa-edit"></i></button> |
    							<button class="btn btn-link p-0 text-decoration-none" onclick='if(confirm("Do you want to delete ?")){ location.href="delete_customer.php?id=<?php echo $row['id']; ?>";}'>Delete <i class="fas fa-trash-alt"></i></button>
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