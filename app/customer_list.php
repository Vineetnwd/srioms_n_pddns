<?php include('header.php');?>
<?php include('menu.php');
if(isset($_GET['scan_by']))
{
	$status = $_SESSION['status'] =$_GET['scan_by'];
}
else if(isset($_SESSION['status']))
{
	$status = $_SESSION['status'];
}
else{
	$status ='PENDING';
}
?>
 
<div class="content p-4">
		<div class='row'>
			<div class='col'>
				<form action ='' method='get'>
                <h2 class="mb-4">Manage Customer Details	</h2>
				
			</div>
			<div class='col-3 text-right'>
				<form action ='' method='get'>
				<select name='scan_by' onChange='submit()' class='h2'>
					<?php dropdown($status_list,$status); ?>
				</select>
				</form>
				</div>
			</div>	
	<div class="card mb-4">
        <div class="card-body">
                            <div class="table-responsive">
                              <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead>
									<?php if($user_type=='ADMIN'){?>	
										<tr>
										<td colspan='8' align='center'>
										<span class='btn btn-info btn-xs'>
										<input type="checkbox" id="selectall" onClick="selectAll(this)" class='btn'/> Select All
										</span>
										<button class='status_btn btn btn-success btn-xs' data-status='DELIVERED' >DELIVERED</button>
										<button class='status_btn btn btn-warning btn-xs' data-status='CANCELED'>CANCEL</button>
										<button class='status_btn btn btn-danger btn-xs' data-status='DELETE'>DELETE </button>
										</td>
										</tr>
									<?php }?>
                                        <tr>
                                           
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Address </th>
                                            <th>Status </th>
                                            <th>Amount </th>
                                            <th>Date Time </th>
                                            <th>Status</th>
                                            <th>Operation.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
										if($status!='')
										{
										$sql ="select * from customer_details where status ='$status' order by id desc ";
											
										}
										else{
											$sql ="select * from customer_details where status <>'AUTO' order by id desc ";
										}
										
										$res = mysqli_query($con,$sql) or die ("Error in selecting Customer". mysqli_error($con));
										
										while($row =mysqli_fetch_array($res))
										{
										$customer_id =$row['id'];
										$link = encode('customer_id='.$customer_id);
										
										echo"<tr><td>".$row['name']."</td>";
										echo"<td>".$row['mobile']."</td>";
										echo"<td>".$row['address'].", ". $row['city']." ".  $row['email']."</td>";
                                        echo"<td>".$row['status']."</td>";
                                        echo"<td>".$row['amount']."</td>";
										echo"<td>".date('d-M-Y h:i a', strtotime($row['created_at']))."</td>";
										echo"<td>".$row['status']."</td>";
                                       
                                        echo"<td align='right'>";
										echo "<input type='checkbox' value ='$customer_id' name='sel_id[]' class='chk'> &nbsp;";
										?>
										<a href='show_invoice.php?link=<?php echo $link;?>' class='btn btn-danger btn-xs'> View Order </a>
										
										<?php
									    echo "</td></tr>";
										}
                                      ?>
                                    
                                    </tbody>
                                </table>
								<?php 
									if(isset($_GET['action']) and $_GET['action'] =='delete')
									{
										$center_id =$_GET['center_id'];
										$sql ="delete from center_details where center_id =$center_id";
										mysqli_query($con,$sql) or die("Error in Center Delete " .mysqli_error($con));
									Echo "<script>window.location='manage_center.php'</script>"; 
									} 
									
									if(isset($_GET['action']) and $_GET['action'] =='block')
									{
										$center_code =$_GET['center_code'];
										$sql2 ="update user set user_status ='BLOCK' where user_name ='$center_code'";
										
										//UPDATE `user` SET `user_status` = 'ACTIVE' WHERE `user`.`user_id` = 16;
										mysqli_query($con,$sql2) or die("Error in Center Blocking " .mysqli_error($con));
									
									} 
								?>
                            </div>
            </div>

        </div>
</div>


    <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id='appmodal'>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"> Recharge </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<form action ='add_to_wallet' method ='post' id='wallet_frm'	enctype='multipart/form-data'>
						<div class="form-group">
							<label> Centre Code </label>
							<input  name='center_id' id='center_id' type='hidden' required>
							<input class="form-control" id ='center_code' maxlength='8' readonly required>
						</div>
						<div class="form-group">
							<label>Txn Date</label>
							<input class="form-control"  type='date' value ='<?php echo date('Y-m-d'); ?>' name='txn_date' required>
						</div>	
						<div class="form-group">
							<label>Txn Amount</label>
							<input class="form-control"  type='number' value ='' name='credit_amt' required autofocus>
						</div>
																
						<div class="form-group">
							<label>Remarks </label>
							<input class="form-control" placeholder="Details of Transaction" name='txn_remarks' required>
						</div>
					</form>
					
					<button class="btn btn-success" id='add_wallet'> Update Transaction Details </button>
				
                </div>
            </div>
        </div>
    </div>
<?php require_once('footer.php'); ?>	

	<script>
        $('.ls-modal').on('click', function(e){
		  e.preventDefault();
		  $('#appmodal').modal('show');
		  
		  $("#center_id").val($(this).attr("data-center"));
		  $("#center_code").val($(this).attr("data-code"));
		});
	</script>	