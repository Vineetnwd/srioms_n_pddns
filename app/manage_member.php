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
if(isset($_GET['ref_by']))
{
	$ref_by = $_GET['ref_by'];
}
// else if(isset($_SESSION['ref_by']))
// {
// 	$ref_by = $_SESSION['ref_by'];
// }
else{
	$ref_by =null;
}
?>
<div class="content p-4">
	<div class='row'>
		<div class='col-9'>
		<h2 class="mb-4">Manage Member
		<button class='btn btn-primary btn-xs' onClick ='exportxls()'> Export </button>
		</h2>
		</div>
		<div class='col-3 text-right'>
		<form action ='' method='get'>
		<select name='scan_by' onChange='submit()' class='h2'>
			<?php dropdown($product_status_list,$status); ?>
		</select>
		</form>
		</div>
	</div>				
 
				
	<div class="card mb-4">
        <div class="card-header">
			List of Members
			<div class='float-right'>
			<a href='add_member.php' class='btn btn-warning btn-xs' >Add New</a>
			<span class='btn btn-info btn-xs'>
			<input type="checkbox" id="selectall" onClick="selectAll(this)" class='btn'/> Select All </span>
			<button class='active_block btn btn-success btn-xs' data-table='member' data-pkey='id'  data-status='ACTIVE'>ACTIVE</button>
			<button class='active_block btn btn-danger btn-xs' data-table='member' data-pkey='id'  data-status='PENDING'>PENDING</button>
			
				</div>
		</div>
        <div class="card-body">
			<div class="row">
								
				<div class="col-lg-12">
								
								<!--    Basic Table  -->
								<table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            
                                            <th>Ref By</th>
                                            <th>Membership Id</th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Mobile</th>
                                            <!--<th>Address</th>-->
                                            <th>Wallet</th>
                                            <th>Expiry Date</th>
                                            <th>Photo</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
										
                                    </thead>
                                    <tbody>
									<?php
									
									if($ref_by ==null)
									{
									$res = get_all('member','*', array('status'=>$status));
									}
									else{
									$res = get_all('member','*', array('ref_by'=>$ref_by));    
									}
									if($res['count']>0)
									{	
									foreach($res['data'] as $row)
									{
											echo "<tr>";
											$id=$row['id'];
											 $link =encode("member_id=".$id);
											  $view_link = 'view_data.php?link='.encode('table=member&id='.$row['id']);
										     $view_title = $row['name'];
											 $ct = get_all('member','*', array('ref_by'=>$id))['count'];
											echo "<td> ". get_data('member',$row['ref_by'],'name')['data']."</td>";
											echo "<td><a href='print_card?link=".$link."' target='_blank'> ". $row['membership_id']."</a></td>";
											echo "<td> ". $row['name']."</td>";
											
										if($row['user_type'] =='ADVISOR')
										{
										echo "<td><a href='manage_member?ref_by=".$id."'>". $row['user_type']."</a> ";
										
										echo "<span class='badge badge-danger'> ".$ct."</span></td>";
										}
										else{
										   echo "<td> ". $row['user_type']."</td>"; 
										}
										
											echo "<td> ". $row['mobile'] ."</td>";
										//	echo "<td> ". $row['address'] ."</td>";
											echo "<td><a href='wallet_txn?link=".$link."'>". $row['current_wallet'] ."</a></td>";
											echo "<td> ". $row['expiry_date'] ."</td>";
											echo "<td> <img src='upload/". $row['photo']."' width='35' height='35x'></td>";
											echo "<td> ". $row['status'] ."</td>";
									?>
											<td align='right'>
											<input type='checkbox' value ='<?php echo $id; ?>' name='sel_id[]'  class='chk'>
											<a href='add_member?id=<?php echo $id; ?>' class=' btn btn-info btn-xs text-light' title='Edit'> <i class='fa fa-edit'></i> </a>
										<a data-href='<?php echo $view_link; ?>' class='view_data btn btn-success btn-xs text-light' data-title='<?php echo $view_title;?>'><i class='fa fa-eye'></i></a> 
	                                    
	                                  
										<button class='delete_btn btn btn-danger btn-xs' class='delete_btn' data-table='member' data-id='<?php echo $id; ?>' data-pkey='id' title='Detete Member Permanently'  <?php if($ct>0) echo "disabled"; ?>> <i class='fa fa-trash'></i> </button>
									
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