<?php require('header.php');?>
<?php require('menu.php');

$data = decode($_GET['link']);
//print_r($data);
$member_id=$data['member_id'];
$member = get_data('member', $member_id)['data'];
$inv_id = invopen($member_id)['id'];
$txn_date =get_data('invoice',$inv_id,'txn_date')['data'];
$cw = $member['current_wallet'];
if(isset($_SESSION['inv_no']))
{
	$inv_no =$_SESSION['inv_no'];
	$txn_date =$_SESSION['txn_date'];
}
else{
	$inv_no='';
	$txn_date = date('Y-m-d');
}

?>
<div class="content p-4">
				
   <h2 class="mb-4">Transaction Entry </h2>
				
	<div class="card mb-4">
        <div class="card-header">
                  
                            <div class="row justify-content-md-center">
								<div class="col-lg-8 col-sm-12">
                                    <form  action ='txn_entry' enctype='multipart/form-data' id='item_frm'>
									    <div class="form-group">
                                            <label> Member Details </label><br>
											<input type='hidden'  name='inv_id' value='<?php echo $inv_id; ?>' >
											<input type='hidden'  value='<?php echo $member_id; ?>' name='member_id' >
                                            
									<h3>	<?php echo $member['name']?>
									<small class='text-muted'>
									<?php echo  $member['user_type']?></small> </h3>
									<?php echo  $member['address']?> </br>
									<?php echo $member['mobile']?> <br> 
									<span class='btn btn-border border-primary btn-md'> Rs. <?php echo $member['current_wallet']?> </span>
									</div>
									</div>
								
									<div class="col-lg-4 col-sm-12">
                                
										<div class="form-group">
                                            <label>Invoice No.</label>
                                           <input class="form-control"  name='invoice_no' value='<?php echo $inv_id; ?>'  required id='inv_no'>
                                        </div>
									   <div class="form-group">
                                            <label>Date of Txn </label>
                                            <input class="form-control" required type='date' name='txn_date' value='<?php echo $txn_date; ?>' >
                                        </div>	
									</div>
							</div>
					</div>
					<div class="card-body">
					    <div class='row justify-content-md-center'>
    						<div class="col-lg-4 " >
                            <div class="form-group">
                            <label>Service/Product</label>
                            <select name ='service_id' class='form-control'>
                                <?php dropdownlist('services','id','name'); ?>
                            </select>
                            </div>
                            	</form>
    						</div>
    							 
    						
    						<div class="col-lg-2 col-sm-6">
    								<div class="form-group">
    								
    								<label> &nbsp; </label><br>
                                    
    								<input type="button" class="btn btn-success btn-block" value='Add to Invoice' id='add_item_btn'>
    								</div>
    						</div>
						</div>				
                            
                            <table id="item_tbl" class="table table-hover table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                           
                                            <th>Decription  </th>
                                            <th>Rate </th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
										$sql ="select * from txn where inv_id='$inv_id' order by txn_id desc "; 
										$t =0;
										$i=1;
										
										$res = mysqli_query($con,$sql) or die ("Error in Txn Report ". mysqli_error($con));
										
										while($row =mysqli_fetch_array($res))
										{
										$txn_id =$row['txn_id'];
										$t =$t +$row['amount'];	
										echo"<tr class='odd gradeX'>";
										//echo"<td>". $i."</td>";
										echo"<td>".$row['txn_remarks']."</td>";
										//echo"<td class='qty' >".$row['quantity']."</td>";
										echo"<td>".$row['rate']."</td>";
									    echo"<td align='right' class='amt'>".$row['amount']."</td>";
									    echo"<td align='right'> <span data-id='".$txn_id."' class='delete_btn' data-pkey='txn_id' data-table='txn' ><i class='fa fa-trash btn-xs'></i></span></td>";
										echo "</tr>";
										$i++;
										}
                                       ?>
                                     </tr> 
                                    </tbody>
									<tfoot>
										<tr>
										<td colspan='2'> Total </td>
										<td align='right' id='qsum'><b>  </b> </td>
										<td align='right' id='asum'><b> <?php echo $t; ?>  </b> </td>
										
										</tr>
									</tfoot>
                                </table>
                            </div>
                    <div class="card-body">      
						<div class='row'>
							<div class="col-lg-2 col-sm-6"> 
							<form action='close_invoice' method='post'  id='update_frm'>
							<div class="form-group">
                                            <label>Special Discount (in Rs.) </label>
                                            <input class="form-control"  id ='prev' name='prev_dues' value='<?php echo get_data('member',$member_id,'current_wallet')['data']; ?>' type ='hidden' >
										  <input class="form-control"  name='discount' id ='discount' required value='' onkeyup='diff()'>
                                        </div>	
                                        
                            </div>
							<div class="col-lg-2 col-sm-6">
										<div class="form-group">
                                            <label> Net Payable </label>
											<input type='hidden' name='inv_id' value='<?php echo $inv_id; ?>' >
											<input type='hidden' name='total' id='total' value='<?php echo $t; ?>' >
											<input type='hidden' value='<?php echo $inv_no; ?>' id='dinv_no' required>
											<input type='hidden'  value='<?php echo $member_id; ?>' name='member_id' >
											<input type="hidden"  name='txn_date' required value='<?php echo date('Y-m-d',strtotime($txn_date)); ?>'>
                                        
                                            <input class="form-control"  name='payment' id ='payment' required value='<?php echo $t; ?>' type='hidden' >
                                            
                                            <input class="form-control"  name='discount' id ='netpayable' required value='' readonly>
                                        </div>
                                         
                                           
							</div>			
							<div class="col-lg-2 col-sm-6">
							
										<div class="form-group">
                                            <label>Current Dues/ Advance </label>
                                            <input class="form-control text-danger"  name='dues'  id ='dues' readonly value='<?php echo $cw -$t;?>' required>
											
                                        </div>
                            </div>
							<div class="col-lg-4 col-sm-6">
                                
									
                                     	<div class="form-group">
										 <label> Remarks </label>
                                            <input class="form-control"  name='txn_remarks'  >
                                           
                                        </div>
                                </div>
							</form>
							<div class="col-lg-2 col-sm-6">
									<div class="form-group">
                                        <br>
										<input type="button" class="btn btn-danger btn-block" value='Close Invoice' id='update_btn'>
                                	</div> 
                            </div>
							
							
							</div>
					</div>
                    </div>
					
	<?php require_once('footer.php'); ?>
<script>

$("#inv_no").keyup(function(){
    $("#dinv_no").val($(this).val());
})
function updateinvoice()
{
    var qsum = 0;
    $(".qty").each(function(){
        qsum += +$(this).val();
    });
    $("#qsum").val(qsum);
	
	var asum = 0;
    $(".amt").each(function(){
        asum += +$(this).val();
    });
    $("#asum").val(asum);
}    
	
	function bal()
	{
	//alert("hello");	
	var d  = document.getElementById("qty").value;
	var m = document.getElementById("rate").value;
	var b =parseFloat(m) * parseFloat(d);
	document.getElementById("amount").value = parseFloat(b).toFixed(2);

	}

	function diff()
	{
	 //alert("hello");	
	var prev  = document.getElementById("prev").value;
	var t  = document.getElementById("total").value;
	var d  = document.getElementById("discount").value;
	//var p= document.getElementById("payment").value;
	var n =(parseFloat(t) - parseFloat(d));
	var cd =(parseFloat(prev) - parseFloat(n));
	document.getElementById("dues").value = parseFloat(cd).toFixed(2);
	document.getElementById("netpayable").value = parseFloat(n).toFixed(2);
	}

</script>
