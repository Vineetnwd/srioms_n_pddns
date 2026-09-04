<?php require_once('header.php'); ?>
<?php
if(isset($_SESSION['user_id']))
{
	$user_id = $_SESSION['user_id'];
	$user_type = $_SESSION['user_type'];
	$user_name = $_SESSION['user_name'];
	$ut = get_data('user',$user_id,'token','user_id')['data'];
	//echo "<br>". $token;
	if($token != $ut)
	{
		echo "<script> window.location ='master_process?task=logout' </script>";
	}
}
else{
	echo "<script> window.location ='login' </script>";
}
?>
<body class="bg-light">

    <nav class="navbar navbar-expand navbar-dark bg-primary">
        <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
        <a class="navbar-brand" href="index"><?php echo $inst_name; ?></a>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="#" class="nav-link"><i class="fa fa-envelope"></i> 5</a></li>
               <li class="nav-item dropdown">
                    <a href="#" id="notice_count" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user" id='notification'>
                       
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user_name; ?></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                        <a href="#" class="dropdown-item">Profile</a>
                        <a href="#" class="dropdown-item" onClick='logout()'>Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="d-flex">
        <div class="sidebar sidebar-dark bg-dark">
            <ul class="list-unstyled">
                <li><a href="dashboard"><i class="fa fa-cubes fa-fw"></i> Dashboard</a></li>
               
				<li>
					<a href="#sm_student" data-toggle="collapse">
						<i class="fa fa-male fa-fw"></i> Student Management
					</a>
					<ul class="list-unstyled collapse" id="sm_student">
						<li>
							<a href="add_student" accesskey='a'> <span class='hotkey'>A</span>dd Student</a>
						</li>
						<li><a href="manage_student" accesskey='m'> <span class='hotkey'>M</span>anage Student</a>
						</li>
					</ul>
				</li>
				<li>
                        <a href="#sm_course" data-toggle="collapse">
							<i class="fa fa-book fa-fw"></i> Course Management</a>
                        <ul class="list-unstyled collapse" id="sm_course">
							<li><a href="add_course"> Add Course</a></li>
							<li><a href="manage_course"> Manage Course</a></li>
							<li><a href="add_paper">Add Exam Paper </a></li>
							<li><a href="docs_upload">Add New Topics </a></li>
							<li><a href="question">Add Questions </a></li>
						</ul>
				</li>
				<li>
                        <a href="#sm_center"  data-toggle="collapse"><i class="fa fa-laptop fa-fw"></i> Center Management</a>
                        <ul class="list-unstyled collapse" id="sm_center">
							<li>
								<a href="add_center" class='menu_link' ><i class="fa fa-laptop fa-fw"></i> New Center / Franchisee</a>
							</li>
							<li>
								<a href="manage_center"><i class="fa fa-table fa-fw"></i> Manage Center </a>
							</li>
						
						    <li> 
								<a href="send_sms"><i class="fa fa-envelope fa-fw"></i> Send SMS</a>
							</li>
						</ul>
					</li>
					<li>
                        <a href="#sm_print"  data-toggle="collapse"><i class="fa fa-print fa-fw"></i> Print Management</a>
                        <ul class="list-unstyled collapse" id="sm_print">
							<li>
								<a href="print_result"><i class="fa fa-print fa-fw"></i> Marks Sheet & Certificate </a>
							</li>
							<li>
								<a href="admin_download_student"><i class="fa fa-download fa-fw"></i> Identity Card </a>
							</li>
						</ul>
					</li>
					<li>
                        <a href="#sm_txn"  data-toggle="collapse"><i class="fa fa-paste fa-fw"></i> Trans. Management</a>
                        <ul class="list-unstyled collapse" id="sm_txn">
							<li>
								<a href="show_user"><i class="fa fa-user fa-fw"></i> View User</a>
							</li>
							<li>
								<a href="txn_view"><i class="fa fa-medkit fa-fw"></i> View Transactions</a>
							</li>
						</ul>
					</li>
					
				    <li>
                        <a href="show_topics"><i class="fa fa-download fa-fw"></i> Study Material</a>
					</li>    
					<li>
                        <a href="show_question"><i class="fa fa-question fa-fw"></i> Practice Set</a>
					</li>            
					
				<li>
                        <a href="#sm_web"  data-toggle="collapse"><i class="fa fa-globe fa-fw"></i> Website Management</a>
                        <ul class="list-unstyled collapse" id="sm_web">
							<li>
								<a href="notice"><i class="fa fa-edit fa-fw"></i> Notice Board</a>
							</li>
                            <li>
							<a href="gallery"><i class="fa fa-picture-o fa-fw"></i> Manage Gallery  </a>
							</li>
							<li>
							<a href="video"><i class="fa fa-youtube fa-fw"></i> Manage Video  </a>
							</li>
							<li>
							<a href="show_enquery"><i class="fa fa-table fa-fw"></i> Manage Enquiry  </a>
							</li>
                        </ul>
                    </li>
				
            </ul>
        </div>
		
<div id='main_area'>	

</div>
	
<?php require_once('footer.php'); ?>
<script>
	$('.menu_link').on('click', function(e){
	  e.preventDefault();
	  $('#main_area').load($(this).attr('href'));;
	  //$('#appmodal').modal('show').find('.modal-body').load($(this).attr('href'));
	});
</script>

