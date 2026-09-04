<?php require_once('header.php'); ?>
<?php require_once('menu.php'); ?>
<div class="content p-4">
        	
        <h2 class="mb-4">SEND SMS </h2>
		<div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
           Enter SMS Details
        </div>
        <div class="card-body">
			<div class='row'>
					<div class='col-md-4'>	
									<form action='#' method='post'>
										
										<div class="form-group">
                                            <label>Select Customer </label>
											 <select class="form-control" name='mobile' required>
											     <option value=''>Select to Send</option>
											     <option value='ALL_CUSTOMER'>All Customer</option>
                                                <?php dropdownlist('customer_details','mobile','name', null, 'mobile'); ?>
                                            </select>
                                        </div>	
										<div class="form-group">
                                            <label>Message (160 charecter Per SMS) </label>
                                            <textarea class="form-control" rows="3" name='message' required></textarea>
                                        </div>
					
										<div class="form-group">
											<input type="submit" class="btn btn-md btn-danger "  name='SEND_ALL' value='SEND SMS'>
										</div>
									</form>
						</div>
				
						<div class="col-lg-8">
									<form action='send_sms' method='post' id='sms_frm'>
										<div class="form-group">
                                            <label>Enter Mobile Nos. </label>
                                            <textarea class="form-control" rows="2" name='mobile' id='mobile' placeholder='Example: 9431XXXXXX,9835XXXXXX,9934XXXXXX or Use Enter'></textarea>
											
										</div>
										
										<div class="form-group">
                                            <label>Message (160 charecter Per SMS) </label>
                                            <textarea class="form-control" rows="2" name='message2'id='message' required></textarea>
                                        </div>
								
										<div class="form-group">
											<input type='button' class="btn btn-md btn-danger"  id='send_sms' value='SEND SMS TO NUMBER'>
										</div>
									</form>
						</div>
				
					</div>
                </div>
				<div class="col-lg-12"> 
						
                                
				
				<?php 
				if(isset($_POST['SEND_ALL']))
				{
				$mobile =$_POST['mobile'];
				$msg =$_POST['message'];
					
					if ($mobile =='ALL_CUSTOMER')
						{
							$mobile =create_list('customer_details','mobile');
							$mobile = implode(",",$mobile);
							$count = count($mobile);
				
						}
				   
				   	echo $mobile . $count . $msg;
					print_r(sendsms($mobile,$msg));
				    //$no ='';
					//unset($_POST['SEND_ALL']);
				}
				
				
				?>
				
            </div>
				
	</div>
</div>
</div>
 <?php echo require_once('footer.php'); ?>