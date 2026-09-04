<?php
if(isset($_SESSION['user_id']))
{
 	$user_id = $_SESSION['user_id'];
	$user_type = $_SESSION['user_type'];
	$user_name = $_SESSION['user_name'];
	$ut = get_data('user',$user_id,'token','user_id')['data'];
	if($user_type =='CLIENT')
	{
		$wallet = get_data('center_details',$user_name,'center_wallet','center_code')['data'];	
	}
	
	if($token != $ut)
	{
	   
		echo "<script> logout() </script>";
	}
}
else{
	echo "<script> window.location ='login' </script>";
}
//verify($user_type);
?>

<body class="bg-light">

    <nav class="navbar navbar-expand navbar-dark bg-primary">
        <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
        <a class="navbar-brand" href="#"><?php echo $inst_name; ?></a>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ml-auto">
            
                <li class="nav-item dropdown">
                    <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user_name; ?></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                        <a href="#" class="dropdown-item">Profile</a>
                        <a href="change_password" class="dropdown-item">Change Password</a>
                        <a href="#" class="dropdown-item" onClick='logout()'>Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="d-flex">
        <div class="sidebar sidebar-dark bg-dark">
        
            <ul class="list-unstyled">
                    <li>
						<a href="index"> <i class="fa fa-dashboard fa-fw"></i> Dashboard </a>
					</li>
				
					<li>
                        <a href="manage_member"><i class="fa fa-male fa-fw"></i> Manage Member</a>
                    </li>
					<li>
                        <a href="#sm_product"  data-toggle="collapse"><i class="fa fa-cubes fa-fw"></i> Products /Services </a>
                        <ul class="list-unstyled collapse" id="sm_product">
							<li>
								<a href="add_product"><i class="fa fa-cube fa-fw"></i> Add New </a>
							</li>
							<!--<li>
								<a href="add_stock"><i class="fa fa-plus fa-fw"></i> Add Stock </a>
							</li>-->
							<li>
								<a href="manage_product"><i class="fa fa-cubes fa-fw"></i> Manage Products </a>
							</li>
						</ul>
					</li>
					<!--<li>
                        <a href="services"><i class="fa fa-user fa-fw"></i> Manage Services</a>
                    </li> -->	
                    <li>
                        <a href="recharge"><i class="fa fa-inr fa-fw"></i> Manage Recharge</a>
                    </li>
					
					
					  <li>
                        <a href="transaction" ><i class="fas fa-exchange-alt fa-fw"></i> Transaction </a>
					</li>
					<li>
                        <a href="#sm_rpt"  data-toggle="collapse"><i class="fa fa-print fa-fw"></i> Report </a>
                        <ul class="list-unstyled collapse" id="sm_rpt">
						    	<li>
            						<a href="collection_report"> Collection Report </a>
            					</li>
            					<li>
            						<a href="wallet_txn">Transaction Log</a>
            					</li>
            				
								<li>
            						<a href="appointment">Service Request</a>
            					</li>
            					<li>
            						<a href="medicine_order">Medicine Order</a>
            					</li>
								<li>
            						<a href="sms_report">SMS Report</a>
            					</li>
						</ul>
					</li>
					
					
					<!--<li>
                        <a href="brand"><i class="fa fa-diamond" aria-hidden="true"></i> Manage Brand</a>
                    </li>
					<li>
                        <a href="category"><i class="fa fa-list fa-fw"></i> Manage Membe</a>
                    </li>
                    <li>
                        <a href="add_product"><i class="fa fa-cube fa-fw"></i> Add Product</a>
                    </li>
					<li>
                        <a href="manage_product"><i class="fa fa-cubes fa-fw"></i> Manage Product</a>
                    </li>
					
                   
					<li>
                        <a href="manage_order"><i class="fa fa-shopping-cart fa-fw"></i> Manage Order</a>
                    </li>
                    
                    	<li>
                        <a href="demand_report"><i class="fa fa-table fa-fw"></i> Demad Report</a>
                    </li>
					
                    <li>
                        <a href="bulk_update"><i class="fa fa-upload fa-fw"></i> Bulk Update</a>
                    </li>
                    <li>
                        <a href="order_book"><i class="fa fa-inr fa-fw"></i> Order Book </a>
                    </li>
                    <li>
                        <a href="offer"><i class="fa fa-flash fa-fw"></i> Add Offer</a>
                    </li>
                    -->
					<li> 
						<a href="#send_sms"><i class="fa fa-envelope fa-fw"></i> Send SMS</a>
					</li>

                   
					
            </ul>
        </div>