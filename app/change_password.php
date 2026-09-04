<?php include('header.php');?>
<?php include('menu.php'); ?>
<div class="content p-4">
		
<h2 class="mb-4"> Password	Mangement</h2>
	<div class="card mb-4">
		 <div class="card-header bg-white font-weight-bold">
           Change Password of <?php echo $user_name; ?>
        </div>
        <div class="card-body">
			<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4 col-md-offset-4">

                                    <form action='change_password' id='update_frm' method='post' role="form">
                                        <div class="form-group">
                                            <label>Current Password</label>
                                            <input class="form-control" type='password' id='current_password' required >
                                           
                                        </div>
										
										<div class="form-group">
                                            <label>New Password</label>
                                            <input class="form-control" type='password'  id='new_password' required minlength='5'>
                                            <p class='text-muted'> Always Use Strong Password</p>
                                        </div>
										
										
										<div class="form-group">
                                            <label>Confirm Password </label>
                                            <input class="form-control"  id='repeat_password' required minlength='5'>
                                            
                                        </div>
									</form>
                                <input type="button" class="btn btn-primary" id='change_password' value='Change Password' >
                                        
                                  
                                </div>
                               
                            </div>
<?php require_once('footer.php'); ?>