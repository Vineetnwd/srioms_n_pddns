<?php 
include('header.php');
include('menu.php');
if(isset($_GET['scan_by']))
{
	$status = $_SESSION['status'] =$_GET['scan_by'];
}
else if(isset($_SESSION['status']))
{
	$status = $_SESSION['status'];
}
else{
	$status ='ACTIVE';
}

?>
<div class="content p-4">
	<div class='row'>
		<div class='col-9'>
		<h2 class="mb-4">Manage Appointment
	
		</h2>
		</div>
		<div class='col-3 text-right'>
		<form action ='' method='get'>
		<select name='scan_by' onChange='submit()' class='h2'>
			<?php dropdown($app_status_list,$status); ?>
		</select>
		</form>
		</div>
	</div>				
 
				
	<div class="card mb-4">
        <div class="card-header">
			List of Appointments
			<div class='float-right'>
			
			<span class='btn btn-info btn-xs'>
			<input type="checkbox" id="selectall" onClick="selectAll(this)" class='btn'/> Select All </span>
			<button class='active_block btn btn-success btn-xs' data-table='appointment' data-pkey='id'  data-status='APPROVED'>APPROVED</button>
			<button class='active_block btn btn-danger btn-xs' data-table='appointment' data-pkey='id'  data-status='CANCELED'>CANCEL</button>
			<button class='btn btn-primary btn-xs' onClick ='exportxls()'> Export </button>
				</div>
		</div>
        <div class="card-body">
			<div class="row">
								
				<div class="col-lg-12">
								
								<!--    Basic Table  -->
								<table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            
                                            <th>Membership Id</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>App Type</th>
                                            <th>App For</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
										
                                    </thead>
                                    <tbody>
									<?php
									
									if($ref_by ==null)
									{
									$res = get_all('appointment','*', array('status'=>$status));
									}
									else{
									$res = get_all('appointment','*', array('ref_by'=>$ref_by));    
									}
									if($res['count']>0)
									{	
									foreach($res['data'] as $row)
									{
											echo "<tr>";
										$id=$row['id'];
										$member_id=$row['member_id'];
											 $link =encode("member_id=".$member_id);
										  $member =  get_data('member',$member_id)['data'];
										$product_name =  get_data('product',$row['product_id'],'product_name')['data'];
										echo "<td> ". $member['membership_id']."</td>";
										echo "<td> ". $member['name']."</td>";
										echo "<td> ". $member['mobile'] ."</td>";
									
										echo "<td> ". $row['product_type'] ."</td>";
										echo "<td> ". $product_name ."</td>";
										echo "<td> ". $row['app_date'] ."</td>";
										echo "<td> ". $row['app_time'] ."</td>";
										echo "<td> ". $row['remarks'] ."</td>";
											echo "<td> ". $row['status'] ."</td>";
									?>
											<td align='right'>
											<input type='checkbox' value ='<?php echo $id; ?>' name='sel_id[]'  class='chk'>
										<!--	<a href='add_member?id=<?php echo $id; ?>' class=' btn btn-info btn-xs text-light' title='Edit'> <i class='fa fa-edit'></i> </a>
											<span class='delete_btn' data-table='appointment' data-id='<?php echo $id; ?>' data-pkey='id' title='Detete Member Permanently'> <i class='fa fa-trash'></i> </span>-->
											</td>
											</tr>
									<?php
									}
									}
									?>
                                       
                                    </tbody>
                                </table>
                      </div>
                      </div>
                      </div>
    
                   
<?php require_once('footer.php'); ?>