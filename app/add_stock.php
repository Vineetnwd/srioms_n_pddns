
<?php require('header.php');?>
<?php require('header.php');?>
<?php require('menu.php');
$data = decode($_GET['link']);
//print_r($data);
$member_id=$data['member_id'];
$member = get_data('member', $member_id)['data'];
$invoice_id = invopen($member_id)['id'];
$invoice =get_data('invoice',$invoice_id)['data'];
extract($invoice);
$cw = $member['current_wallet'];

if(isset($_SESSION['invoice_type']) and $_SESSION['invoice_type'] !='')
{
	$invoice_type =$_SESSION['invoice_type'];
}
if(isset($_SESSION['invoice_no']) and $_SESSION['invoice_no'] !='')
{
	$invoice_no =$_SESSION['invoice_no'];
	$txn_date =$_SESSION['invoice_date'];
}
else{
	$invoice_no =$invoice_id;
	$txn_date = date('Y-m-d');
}

?>
<div class="content p-4">
				
   <h2 class="mb-4">Medicine Sale </h2>
				
	<div class="card mb-4">
        <div class="card-header">
                   
                            <div class="row justify-content-md-center">
								<div class="col-lg-8 col-sm-12">
                                 	    <div class="form-group">
										  <form  action ='medicine_entry' enctype='multipart/form-data' id='item_frm'>
                                            <label> Member Details </label><br>
											<input type='hidden'  name='invoice_id' id='invoice_id' value='<?php echo $invoice_id; ?>' >
											<input type='hidden'  value='<?php echo $member_id; ?>' name='member_id' id='member_id' >
                                            
									<h3>	<?php echo $member['name']?>
									<small class='text-muted'>
									<span id='user_type'><?php echo  $member['user_type']?></span></small> </h3>
									<?php echo  $member['address']?> </br>
									<?php echo $member['mobile']?> <br> 
									<span class='btn btn-border border-primary btn-md'> Rs. 
									<span id='cw'><?php echo $member['current_wallet']?></span> 
									
									</span>
									</div>
									</div>
								
									<div class="col-lg-4 col-sm-12">
										<div class='row'>
										<div class="form-group col-md-6">
                                            <label>Invoice Type</label>
                                           <select class='form-control' id='invoice_type' name='invoice_type'>
												<?php dropdown($invoice_type_list,$invoice_type); ?>
											</select>
                                        </div>
										<div class="form-group col-md-6">
                                            <label>Invoice No.</label>
                                           <input class="form-control"  name='invoice_no' value='<?php echo $invoice_no; ?>'  required id='invoice_no'>
                                        </div>
                                        </div>
									   <div class="form-group">
                                            <label>Date of Txn </label>
                                            <input class="form-control" required type='date' name='invoice_date' value='<?php echo $txn_date; ?>' id='invoice_date'>
                                        </div>	
									</div>
							</div>
					</div>
					<div class="card-body">
					    <div class='row py-2' style='background:#f6f3f4;'>
							
    						<div class="col-lg-3" >
								<div class="form-group">
								<label>Product</label>
								<?php $data_list = get_all('product')['data']; ?>
								<select name ='product_id' class='offselect form-control' id='product_search' required>
									<option value=''> Select Product</option>
									<?php foreach($data_list as $data){
										echo "<option data-rate='".$data['mrp']."' data-discount='".$data['card_discount']."'   value='".$data['id']."' >" .$data['name'] ."</option>";
									} ?>
									
								</select>
								</div>
                            </div>
							<div class="col-lg-1 " >
								<div class="form-group">
									<label>Quantity</label>
									<input type='number' class='form-control' id='pqty' name='qty' min='1' required>
								</div>
							</div>
							<div class="col-lg-2 " >
								<div class="form-group">
									<label>Rate</label>
									<input type='number' class='form-control' id='prate' name='rate' required readonly>
								</div>
							</div>
							<div class="col-lg-2" >
								<div class="form-group">
									<label>Discount (in%)</label>
									<input type='number' class='form-control' id='pdiscount' name='discount' required>
								</div>
							</div>
							<div class="col-lg-2 " >
								<div class="form-group">
									<label>Amount</label>
									<input type='number' class='form-control' id='pamount' name='amount' readonly required>
								</div>
								
							</div>
						</form>
							<div class="col-lg-2 col-sm-4">
    								<div class="form-group">
    								
    								<label> &nbsp; </label><br>
                                    
    								<input type="button" class="btn btn-success btn-block" value='Add Item' id='add_item_btn'>
    								</div>
									
    						</div>
							
						</div>				
                            <hr>
                            <table id="item_tbl" class="table table-hover table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                           
                                            <th>Sr. No.  </th>
                                            <th>Decription  </th>
                                            <th>Qty </th>
                                            <th>Rate </th>
                                            <th width='100px'>Discount(%)</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
										$sql ="select * from txn where invoice_id='$invoice_id' order by txn_id desc "; 
										$t =0;
										$i=1;
										
										$res = mysqli_query($con,$sql) or die ("Error in Txn Report ". mysqli_error($con));
										
										while($row =mysqli_fetch_array($res))
										{
										$txn_id =$row['txn_id'];
										$t =$t +$row['amount'];	
										echo"<tr class='odd gradeX'>";
										echo"<td>". $i."</td>";
										echo"<td>".$row['txn_remarks']."</td>";
										echo"<td class='qty' align='center'>".$row['qty']."</td>";
										echo"<td align='center'>".$row['rate']."</td>";
										echo"<td align='center'>".$row['discount']."</td>";
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
										<th colspan='5'>Grand Total </th>
										<th align='right' id='asum' class='text-right text-danger'> <?php echo $t; ?>  </th>
										<th></th>
										</tr>
									</tfoot>
                                </table>
                            </div>
                    <div class="card-footer" style='background:#f6d7f4;'>      
						<div class='row'>
							
							
							<div class="col-lg-2 col-sm-6">
								<form action='close_invoice' method='post'  id='close_frm'>	
									<label>Special Discount (in Rs.) </label>
								    <input class="form-control"  name='bill_amount' id ='bill_amount' value='<?php echo $t; ?>' required type='hidden'>
								    <input class="form-control"  name='discount' id ='discount' required>
								</div>
								
								<div class="col-md-2 col-sm-4">
							   		<label> Bill </label>
									<input type='text' class='form-control' name='net_payable' id='net_payable' value='<?php echo $t; ?>' readonly>
								</div>	
							
							<div class="col-md-2 col-sm-4">
								<label> Cash </label>
								<input type='text' class='form-control' name='cash' id='cash' value='<?php echo $cash; ?>'>
							</div>
							<div class="col-md-2 col-sm-4">
								<label> Bank </label>
								<input type='text' class='form-control' name='bank' id='bank' value='<?php echo $cash; ?>'>
							</div>
							<div class="col-md-2 col-sm-4">
								<label> Wallet </label>
								
								<input type='text' class='form-control' name='wallet' id='wallet' value='0' readonly>
							</div>
							<!--<div class="col-lg-2 col-sm-6">
							
										<div class="form-group">
                                            <label>Final Dues </label>
                                            <input class="form-control text-danger"  name='dues'  id ='dues' readonly value='' required>
											
                                        </div>
                            </div>
								
							
							<div class="col-lg-8 col-sm-6">
                                       	<div class="form-group">
										 <label> Remarks </label>
                                            <input class="form-control"  name='txn_remarks'  >
                                           
                                        </div>
                                </div>
							</form>-->
							
							<div class="col-lg-2 col-sm-6">
									<div class="form-group">
                                        <br>
										<input type="button" class="btn btn-danger btn-block" value='Close Invoice' id='close_invoice_btn'>
                                	</div> 
                            </div>
							</div>
					</div>
                    </div>
					
	<?php require_once('footer.php'); ?>
<script>
$(document.body).on("change","#product_search",function(){
 var user_type = $("#user_type").text();
 var rate =  $('#product_search').find(':selected').data('rate');
 var discount =  $('#product_search').find(':selected').data('discount');
 if(user_type !='VISITOR')
 {
	 $("#pdiscount").val(discount);
 }
	$("#prate").val(rate);
});

$(document).on("change keyup","#pqty, #pdiscount",function(){
		let r = $("#prate").val();
		let q = $("#pqty").val();
		let d = $("#pdiscount").val();
		console.log(r+q);
		let amount =parseFloat(r) *parseFloat(q);
		if(d=="")
		{
			$("#pamount").val(amount.toFixed(2));
		}
		else{
			amount = amount -(amount*d/100);
			$("#pamount").val(amount.toFixed(2));
		}
});

$(document).on("change keyup","#discount",function(){
		let cw = $("#cw").text();
		let b = $("#bill_amount").val();
		let d = $("#discount").val();
		let n = (parseFloat(b)-parseFloat(d));
		// let tp=0;
		// if(cw <0)
		// {
			// tp = parseFloat(n) - parseFloat(cw);
			// $("#wallet").prop('readonly',true);
		// }
		// else{
			// tp = parseFloat(cw)-parseFloat(n);
		// }
		$("#net_payable").val(n.toFixed(2));
});

$(document).on("change keyup","#cash, #bank, #wallet, #discount",function(){
		let c = $("#cash").val();
		let b = $("#bank").val();
		let w = $("#wallet").val();
		let cw = $("#cw").text();
		let np = $("#net_payable").val() ;
		// if(parseFloat(cw) <= 0)
		// {
			// $("#wallet").prop('readonly',true);
			
		// }
		// else{
			let uw = parseFloat(np)-(parseFloat(c)+parseFloat(b));
			$("#wallet").val(uw.toFixed(2));
		//}
		
		//let d = parseFloat(np)-(parseFloat(c)+parseFloat(b)+parseFloat(w));
		//$("#dues").val(d.toFixed(2));
		
		
		
});

</script>
