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
		<h2 class="mb-4">Manage Orders
	        	<button class='btn btn-primary btn-xs' onClick ='exportxls()'> Export </button>
		</h2>
		</div>
		<div class='col-3 text-right'>
		<form action ='' method='get'>
		<select name='scan_by' onChange='submit()' class='h2'>
			<?php dropdown($order_status_list,$status); ?>
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
			<button class='active_block btn btn-danger btn-xs' data-table='medicine_order' data-pkey='id'  data-status='CANCELED'>Canceled</button>
			<button class='active_block btn btn-info btn-xs' data-table='medicine_order' data-pkey='id'  data-status='DISPATCH'>Dispatched</button>
		    <button class='active_block btn btn-success btn-xs' data-table='medicine_order' data-pkey='id'  data-status='DELIVERED'>Deliverd</button>
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
                                            <th>Date & Time</th>
                                            <th>List</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
										
                                    </thead>
                                    <tbody>
									<?php
									
								
									$res = get_all('medicine_order','*', array('status'=>$status));
									
									if($res['count']>0)
									{	
									foreach($res['data'] as $row)
									{
											echo "<tr>";
										$id=$row['id'];
										$member_id=$row['member_id'];
											 $link =encode("member_id=".$member_id);
										  $member =  get_data('member',$member_id)['data'];
										  
										echo "<td> ". $member['membership_id']."</td>";
										echo "<td> ". $member['name']."</td>";
										echo "<td> ". $member['mobile'] ."</td>";
										echo "<td> ". $row['created_at'] ."</td>";
									
										echo "<td> <img src='upload/". $row['upload_list'] ."' width='100px' height='100px'> </td>";
										echo "<td> ". $row['status'] ."</td>";
									?>
											<td align='right'>
											 <a href='upload/<?php echo $row['upload_list'];?>' download ='<?php echo $member['membership_id'].$row['created_at'];?>' ><i class='fa fa-download'></i> </a>
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