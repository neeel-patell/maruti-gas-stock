<nav class="navbar bg-dark m-0 p-0" style="min-height: 3vh">
	<div class="container-fluid m-0 p-0">
		<div class="navbar">&nbsp;&nbsp;	
			<a class="btn btn-light" href="index.php"><i class="fas fa-home"></i> Home</a>&nbsp;&nbsp;
			<div class="dropdown">
    			<a class="btn btn-light dropdown-toggle" role="button" id="supplier_dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-tractor"></i> Manage Supplier
                </a>&nbsp;&nbsp;
                <ul class="dropdown-menu" aria-labelledby="supplier_dropdown">
                    <li><a class="dropdown-item" href="add_supplier.php"><i class="fas fa-truck"></i> Add Supplier</a></li>
                    <li><a class="dropdown-item" href="view_supplier.php"><i class="fas fa-list"></i> View Suppliers</a></li>
                </ul>
           	</div>
           	<div class="dropdown">
    			<a class="btn btn-light dropdown-toggle" role="button" id="item_dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-sitemap"></i> Manage Item
                </a>&nbsp;&nbsp;
                <ul class="dropdown-menu" aria-labelledby="item_dropdown">
                    <li><a class="dropdown-item" href="add_item.php"><i class="fas fa-satellite"></i> Add Item</a></li>
                    <li><a class="dropdown-item" href="view_item.php"><i class="fas fa-list-alt"></i> View Items</a></li>
                </ul>
           	</div>
           	<div class="dropdown">
    			<a class="btn btn-light dropdown-toggle" role="button" id="incoming_dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-arrow-down"></i> Manage Incoming Stock
                </a>&nbsp;&nbsp;
                <ul class="dropdown-menu" aria-labelledby="incoming_dropdown">
                    <li><a class="dropdown-item" href="add_stock.php"><i class="fas fa-plus-circle"></i> Add Stock</a></li>
                    <li><a class="dropdown-item" href="view_incoming_stock.php"><i class="fas fa-bars"></i> View Stock</a></li>
                </ul>
           	</div>
           	<div class="dropdown">
    			<a class="btn btn-light dropdown-toggle" role="button" id="incoming_dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fab fa-uikit"></i> Manage Kit
                </a>&nbsp;&nbsp;
                <ul class="dropdown-menu" aria-labelledby="incoming_dropdown">
                    <li><a class="dropdown-item" href="add_kit.php"><i class="fas fa-plus-circle"></i> Add Kit</a></li>
                    <li><a class="dropdown-item" href="view_kit.php"><i class="fas fa-bars"></i> View Kit</a></li>
                </ul>
           	</div>
           	<div class="dropdown">
    			<a class="btn btn-light dropdown-toggle" role="button" id="incoming_dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-users"></i> Manage Customer
                </a>&nbsp;&nbsp;
                <ul class="dropdown-menu" aria-labelledby="incoming_dropdown">
                    <li><a class="dropdown-item" href="add_customer.php"><i class="fas fa-plus-circle"></i> Add Customer</a></li>
                    <li><a class="dropdown-item" href="view_customer.php"><i class="fas fa-user-friends"></i> View Customer</a></li>
                </ul>
           	</div>
           	<div class="dropdown">
    			<a class="btn btn-light dropdown-toggle" role="button" id="incoming_dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-receipt"></i> Manage Bills
                </a>&nbsp;&nbsp;
                <ul class="dropdown-menu" aria-labelledby="incoming_dropdown">
                    <li><a class="dropdown-item" href="sell_item.php"><i class="fas fa-plus-circle"></i> Add Bill</a></li>
                    <li><a class="dropdown-item" href="view_bill.php"><i class="fas fa-list"></i> View Bill</a></li>
                </ul>
           	</div>
           	<a class="btn btn-light" href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>&nbsp;&nbsp;
		</div>
	</div>
</nav>