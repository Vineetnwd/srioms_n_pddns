<?php include('header.php');?>
<?php include('menu.php');

if(isset($_GET['from_date']))
{
    $from_date =$_GET['from_date'];
}
else{
    $from_date=date('Y-m-d');
}
if(isset($_GET['to_date']))
{
    $to_date =$_GET['to_date'];
}
else{
    $to_date=date('Y-m-d');
}

?>
 
<div class="content p-4">
		<div class='row'>
			<div class='col-6'>
				<form action ='' method='get'>
                <h2 class="mb-4">SMS Report	
				</h2>
				
			</div>
			<div class='col-6 text-right'>
				<!--<form action ='' method='get'>
				<select name='scan_by' onChange='submit()' class='h2'>
					<?php dropdown($order_status_list,$status); ?>
				</select>
				</form>-->
				</div>
			</div>	
	<div class="card mb-4">
		<?php if($user_type=='Admin'){?>	
			 <div class="card-header">
				<!--<span class='btn btn-info btn-xs'>
				<input type="checkbox" id="selectall" onClick="selectAll(this)" class='btn'/> Select All
				</span>-->
		
			<div class='float-right'>
			<form action ='' method='post'>
				<input type='date' name='from_date' value='<?php echo $from_date;?>'>
				<input type='date' name='to_date' value='<?php echo $to_date;?>'>
				<input type='submit' class='btn btn-success btn-xs' value='SHOW'>
			</form>
			</div>
			</div>
		<?php }?>
        <div class="card-body">
                            <div class="table-responsive">
                              <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead>
								
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th> Mobile No</th>
                                            <th>SMS</th>
                                            <th>Date Time</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
										if(isset($_REQUEST['from_date']) and isset($_REQUEST['to_date']) )
										{
										$sql= "SELECT *  FROM sms_log where date(created_at) between '$from_date' and '$to_date' ORDER BY id DESC";

										
										$res = mysqli_query($con,$sql) or die ("Error in selecting Customer". mysqli_error($con));
										$i=1;
										while($row =mysqli_fetch_array($res))
										{
									   
									
										echo"<tr><td>".$i."</td>";
										echo"<td>".$row['mobile']."</td>";
										echo"<td>".urldecode($row['text'])."</td>";
										echo"<td>".date('d-M-Y h:i a',strtotime(urldecode($row['created_at'])))."</td>";
									    echo "</tr>";
									    $i++;
										
										}
										}
                                      ?>
                                    
                                    </tbody>
                                </table>
							
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