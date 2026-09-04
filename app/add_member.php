<?php 
include('header.php');
include('menu.php');

if(isset($_GET['id']))
{
	$data  = get_data('member',$_GET['id'])['data'];
	extract($data);
}
else{
	$res1  =insert_row('member');
	$id1 = $res1['id'];
	$data  = get_data('member',$id1)['data'];
	extract($data);
}
?>
<div class="content p-4">

	<div class='row'>
		<div class='col-6'>
		<h2 class="mb-4">Membership Details
		</h2>
		</div>
		<div class='col-6 text-right'>
		<a href='manage_member.php' class='btn btn-danger btn-xs' > Manage Member </a>
		</div>
	</div>
	<div class="card mb-4">
		
        <div class="card-header">
			Member Details
			 <button class="btn btn-success btn-sm float-right" id='update_btn'>Save Details </button>
        </div>
		<div class="card-body">
			<div class="row">
					<div class="col-md-4" >
                    
                    	<form action ='add_member' id='update_frm' enctype='multipart/form-data'>
						
							<div class="form-group">
								<label>Select Role</label>
								<select class="form-control" name='user_type' >
									<?php dropdown($user_type_list,$user_type); ?>
								</select>
						</div>
						<div class="form-group">
                            <label>Name*</label>
                            <input class="form-control" type='hidden' value='<?php echo $id; ?>' name='id'  required  >
                            <input class="form-control" value='<?php echo $name; ?>' name='name'  required  >
                        </div>
						
						<div class="form-group">
                            <label>Mobile No.*</label>
                            <input class="form-control" value='<?php echo $mobile; ?>' name='mobile' type='number' required  >
                        </div>
						
						<div class="form-group">
                            <label>Address </label>
                            <textarea class="form-control" name='address' rows='3' ><?php echo $address; ?></textarea>
                        </div>
						<div class="form-group">
                            <label>Date of Birth</label>
                            <input class="form-control" value='<?php echo $date_of_birth; ?>' name='date_of_birth' type='date' max='<?php echo date('Y-m-d'); ?>'  >
                        </div>
						
					</div>
					<div class="col-md-4" >
					    
					    <div class="form-group">
								<label>Gender</label>
								<select class="form-control" name='gender' required>
									<?php dropdown($gender_list, $gender); ?>
								</select>
						</div>
						
						<div class="form-group">
                            <label>Aadhar No.</label>
                            <input class="form-control" value='<?php echo $aadhar_no; ?>' name='aadhar_no'   >
                        </div>
						
					    
						<div class="form-group">
								<label>Ref By</label>
								<select class="offselect form-control" name='ref_by' >
									<option value=''> Select Advisor </option>
									<?php dropdownwhere('member','id','name',array('user_type'=>'ADVISOR'),$ref_by); ?>
								</select>
						</div>
						<div class="form-group">
                            <label>Opening Wallet </label>
                            <input class="form-control" value='<?php echo $opening_wallet; ?>' name='opening_wallet'  required  >
                        </div>
						<div class="form-group">
								<label>Status</label>
								<select class="form-control" name='status' required>
									<?php dropdown($product_status_list, $status); ?>
								</select>
						</div>
						
					
						
					</div>
					<div class="col-md-4" >	
					    <div class="form-group">
						<label>Email ID </label>
						<input class="form-control" value='<?php echo $email_id; ?>' name='email_id'   >
					    </div>
					    
						<input type="hidden" name='photo' id='targetimg' value='<?php echo $photo; ?>' >
						
						<div class="form-group">
                            <label>Date of Joining</label>
                            <input class="form-control" value='<?php echo $joining_date; ?>' name='joining_date' type='date' max='<?php echo date('Y-m-d'); ?>'  >
                        </div>
						
						</form>	
						
						<div class="form-group">
							<label>Upload Photograph  </label>
							<input type='file' id='uploadimg' accept='image' class='form-control' >
						</div>
						
						<img src='upload/<?php echo $photo; ?>' width='100px'  height='100px' id='display'  class='img-thumbnail d-self-centered'> 
						<p> Aspect Ratio 1X1 </p>
						
					</div>	
				      </div>
                      </div>
                   
<?php require_once('footer.php'); ?>