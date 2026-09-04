<?php 
include('header.php');
include('menu.php');

$status =null;
if(isset($_GET['status']))
{
	$status = $_SESSION['status'] =$_GET['status'];
}
if(isset($_SESSION['status']))
{
	$status = $_SESSION['status'];
}
?>
<div class="content p-4">
	<div class='row'>
		<div class='col-9'>
		<h2 class="mb-4">Manage Advisor
		<button class='btn btn-primary btn-xs' onClick ='exportxls()'> Export </button>
		</h2>
		</div>
		<div class='col-3 text-right'>
		<form action ='' method='get'>
		<select name='status' onChange='submit()' class='h2'>
			<?php dropdown($product_status_list,$status); ?>
		</select>
		</form>
		</div>
	</div>				
 
				
	<div class="card mb-4">
        <div class="card-header">
			List of Advisors
			<div class='float-right'>
				<a href='add_advisor.php' class='active_block btn btn-warning btn-xs' >Add New</a>
				<span class='btn btn-info btn-xs'>
				<input type="checkbox" id="selectall" onClick="selectAll(this)" class='btn'/> Select All </span>
				<button class='active_block btn btn-success btn-xs' data-table='advisor' data-pkey='id'  data-status='ACTIVE'>ACTIVE</button>
				<button class='active_block btn btn-secondary btn-xs' data-table='advisor' data-pkey='id'  data-status='PENDING'>PENDING</button>
			
			</div>
		</div>
        <div class="card-body">
			<div class="row">
								
				<div class="col-lg-12">
								
								<!--    Basic Table  -->
								<table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
											<th>Advisor Code</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>Wallet</th>
                                            <th>Expiry Date</th>
                                            <th>Photo</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
										
                                    </thead>
                                    <tbody>
									<?php
									if($status!=null)
									{
										$res = get_all('advisor','*', array('status'=>$status));
									}
									else{
										$res = get_all('advisor');
									}
									
									if($res['count']>0)
									{	
									foreach($res['data'] as $row)
									{
											echo "<tr>";
											$id=$row['id'];
											echo "<td> ". $row['advisor_code']."</td>";
											echo "<td> ". $row['name']."</td>";
											echo "<td> ". $row['mobile'] ."</td>";
											echo "<td> ". $row['address'] ."</td>";
											echo "<td> ". $row['current_wallet'] ."</td>";
											echo "<td> ". $row['expiry_date'] ."</td>";
											echo "<td> <img src='upload/". $row['photo']."' width='35' height='35x'></td>";
											echo "<td> ". $row['status'] ."</td>";
									?>
											<td align='right'>
											<input type='checkbox' value ='<?php echo $id; ?>' name='sel_id[]'  class='chk'>
											<a href='add_advisor?id=<?php echo $id; ?>' class=' btn btn-info btn-xs text-light' title='Edit'> <i class='fa fa-edit'></i> </a>
											
											<span class='ls-modal btn btn-success btn-xs' data-id='<?php echo $id; ?>' data-code='<?php echo $row['name'] ." [". $row['advisor_code'] ."]"; ?>'  title='Recharge Wallet'><i class='fa fa-inr'></i></span>
									  
									  <button class='ls-modal btn btn-success btn-xs' data-member='<?php echo $id; ?>' data-code='<?php echo $row['advisor_code']; ?>' data-name ='<?php echo $row['name']; ?>'><i class='fa fa-inr'></i> Add Money</button>
											
											<span class='delete_btn btn btn-xs btn-danger' data-table='advisor' data-id='<?php echo $id; ?>' data-pkey='id' title='Detete Advisor Permanently'> <i class='fa fa-trash'></i> </span>
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
					<form action ='add_to_advisor' method ='post' id='wallet_frm'	enctype='multipart/form-data'>
						<div class="form-group">
							<label> Member Code </label>
							<input  name='member_id' id='member_id' type='hidden' required>
							<input class="form-control" id ='member_code' readonly required>
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
							<label>Txn Mode</label>
							<select name='txn_mode' class='form-control'>
						    <?php dropdown($txn_mode_list,$txn_mode); ?>
						    </select>
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
        $(document).on('click','.ls-modal',function(e){
		  e.preventDefault();
		  var name =$(this).attr("data-name");
		  var code= $(this).attr("data-code");
		  $('#appmodal').modal('show');
		  
		  $("#member_id").val($(this).attr("data-member"));
		  $("#member_code").val(name +" ["+ code +"]");
		});
	</script>	