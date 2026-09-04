<?php 
include('header.php');
include('menu.php');
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
<div class="content p-4">
				
 <h2 class="mb-4">Transaction Entry</h2>
				
	<div class="card mb-4">
	   <div class='card-header'>
			<form method ='post'>
	        <div class='row justify-content-center'>
				
				<div class='col-md-4 '>
					<input type='text'  class='form-control text' placeholder='Enter Name /Mobile/ Membership Id  to Search' id='search_text' name='search_text' autofocus required>
				</div>
				<div class='col-md-2 '>
					<button class='btn btn-success'> Search </button>
				</div>
			</div>
			</form>
	   </div>
	   	
	   	<?php 
	   	if(isset($_POST['search_text'])) {
		?>
        <div class="card-body">
			
								
								<!--    Basic Table  -->
                     <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Member Id </th>
                                            <th>Name </th>
                                            <th>Type </th>
                                            <th>Mobile </th>
                                            <th>Wallet </th>
                                            <th>Status</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
								
										$i=1;
										$search_text = $_POST['search_text'];
										$query ="SELECT id, name, mobile, membership_id, user_type, status, current_wallet, concat(name,mobile, address ,membership_id ) as f1 FROM `member` having f1 like '%$search_text%'";
									$res5 = mysqli_query($con,$query) or die(" Default Error : ".mysqli_error($con));
									
									
									while($row =mysqli_fetch_array($res5))
									{
									    $id=$row['id'];
									    $membership_id=$row['membership_id'];
									    $link =encode("member_id=".$id);
									  		echo "<tr>";
											echo "<td> ". $i ."</td>";
											echo "<td> ". $row['membership_id'] ."</td>";
											echo "<td> ". $row['name'] ."</td>";
											echo "<td> ". $row['user_type'] ."</td>";
											echo "<td> ". $row['mobile'] ."</td>";
											echo "<td><a href='wallet_txn?link=".$link."'>". $row['current_wallet'] ."</a></td>";
											echo "<td> ". $row['status'] ."</td>";
											
									
									?>
										<td align='right'>
									    <button class='ls-modal btn btn-success btn-xs' data-member='<?php echo $id; ?>' data-code='<?php echo $membership_id; ?>' data-name ='<?php echo $row['name']; ?>'><i class='fa fa-inr'></i> Add Money</button>
										
										<a href='medicine?link=<?php echo $link; ?>' class='btn btn-danger btn-sm'> Invoice </a>
										
										</td>
											</tr>
									<?php
									$i++;
									}
									
									?>
                                       
                                    </tbody>
                                </table>
                      </div>
                <?php } ?>
    <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id='appmodal'>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle"> Recharge / Advance </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<form action ='add_to_wallet' method ='post' id='wallet_frm'	enctype='multipart/form-data'>
						<div class="form-group">
							<label> Member Code </label>
							<input  name='member_id' id='member_id' type='hidden' required>
							<input class="form-control" id ='member_code' readonly required>
						</div>
						<div class="form-group">
							<label>Txn Date</label>
							<input class="form-control"  type='date' value ='<?php echo date('Y-m-d'); ?>' name='txn_date' required>
						</div>	
						<div class='row'>
						<div class="col-md-6" >
								
								<label>Choose Recharge</label> <br>
								<?php $data_list = get_all('recharge')['data']; ?>
								<select class=' form-control' id='recharge_search' required>
									<option value=''> Select Recharge</option>
									<?php foreach($data_list as $data){
										echo "<option data-amount='".$data['amount']."' data-wallet='".$data['wallet']."'   value='".$data['id']."' >" .$data['name'] ."</option>";
									} ?>
									
								</select>
								
                            </div>
							<div class="col-md-6" >
								<div class="form-group">
									<label>Txn Amount</label>
									<input class="form-control"  type='number' value ='' id='txn_amount' name='credit_amt' required autofocus>
								</div>
							</div>
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
		
		$(document.body).on("change","#recharge_search",function(){
		 var amount =  $('#recharge_search').find(':selected').data('amount');
		
		  $("#txn_amount").val(amount);
		});
	</script>	