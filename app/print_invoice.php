<?php include('function.php');
$data =decode($_GET['link']);
$invoice_id =$data['invoice_id'];
$invoice = get_data('invoice',$invoice_id)['data'];
$member = get_data('member',$invoice['member_id'])['data'];
$orders  = get_all('txn','*',array('invoice_id'=>$invoice_id));
?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');
body{
	font-family: 'Open Sans', sans-serif;
	font-size:10px;
}
td,th{
	font-size:12px;
}
@media print { 
 /* All your print styles go here */
 .print1 { display: none !important; } 
}
</style>
<script type="text/javascript" src="assets/js/towords.js"></script>


                               <table  class="table table-hover" cellspacing="0" cellpadding='5px' width="500px" align='left' border='1' rules='rows' >
                                    <thead>
                                        <tr>
                                            <td style='border-right:none;' align='center' colspan='6'> 
                                           
											<img src='assets/img/logo.png' align='left' width='90px'>
											
											
                                            <b style='font-size:20px'><?php echo $inst_name; ?> </b><br>
                                            <b><?php echo $managed_by; ?> </b><br>
                                            <?php echo $inst_address1. ", ". $inst_address2; ?> <br>
                                            <?php echo $inst_contact; ?> |                                    <?php echo $inst_email; ?> <br>
                                            <?php if($invoice['invoice_type']=='INVOICE'){
													echo "GST No. :" .$gst;
											}
											?>
                                            </td>
                                            
                                           
                                        </tr>
                                        <tr bgcolor='#d5d5d5'>
                                              <td colspan='3'> <?php echo $invoice['invoice_type']; ?> No : 
                                              <?php echo $invoice['invoice_no']; ?></td>
                                              <td colspan='3' align='right'> Date : <?php echo date('d-M-Y',strtotime( $invoice['invoice_date'])); ?> </td>

                                        </tr>
                                        <tr>
                                              <td colspan='1'> Name</td>
											  <td colspan='3'><?php echo $member['name']; ?> </td>
											  <td colspan='2'> Mobile :<?php echo $member['mobile']; ?> </td>
                                              
                                        </tr>
										<tr>
											<td colspan='1'>Address </td>
											<td colspan='5'> <?php echo $member['address']; ?> </td>
                                            
                                         </tr>
                                    </thead>
                                    <tbody valign='top'>
									<td colspan='6' height='250px'>
										<table border='0' width='100%' rules='rows' > 
										<tr>
                                        <th align='left' >Sr. No.  </th>
                                        <th colspan='2' align='left'>Description </th>
                                        <th align='right'>Rate </th>
                                        <th align='center'>Quantity </th>
                                        <th align='center'>Discount(%) </th>
                                        <th  align='right' >Amount</th>
                                            
                                        </tr>
										<?php 
										
										$sql ="select * from txn  where invoice_id ='$invoice_id' "; //center_code='$center_code' and txn_date='$txn_date'"; 
										$r =0;
										$p =0;
										$i=1;
										$res = mysqli_query($con,$sql) or die ("Error in Txn Report ". mysqli_error($con));
										while($row =mysqli_fetch_array($res))
										{
										$p =$p +$row['amount'];	
										$r =$r +$row['rate'];	
										echo"<tr class='odd gradeX'>";
										echo"<td>".$i."</td>";
										echo"<td colspan='2' align='left'>".$row['txn_remarks']."</td>";
										echo"<td align='right'>".$row['rate']."</td>";
										echo"<td align='center'>".$row['qty']."</td>";
										echo"<td align='center'> ".$row['discount']."</td>";
										echo"<td align='right'>".$row['amount']."</td>";
										echo "</tr>";
										$i=$i+1;
										} 
                                       ?>
									  </table>
									</td>
                                    </tbody>
									<tfoot>	
										<tr>
											<td rowspan='6' colspan='4'>
											 
										
											</td>
											<td width='150px'> Bill Amount </td>
											<td align='right'> <?php echo $invoice['bill_amount']; ?></td>
										</tr>
										
										<tr>
											<td> Special Discount (Rs.)</td>
											<td align='right'> -<?php echo $invoice['discount']; ?></td>
										</tr>
										
										<tr>
											<td><b> Net Payable </b> </td>
											<td align='right'><b> <?php echo $invoice['net_payable']; ?></b></td>
										</tr>
										
										<tr>
                                            <td> Cash </td>
											<td align='right'> <?php echo $invoice['cash']; ?></td>
										</tr>
										
									
										<tr>
											<td> Bank /Digital </td>
											<td align='right'> <?php echo $invoice['bank']; ?> </td>
										</tr>
									
										<tr>
										   <td> From Wallet </td>
											<td align='right'> <?php echo $invoice['wallet']; ?></td>
										</tr>
									
										<?php if($member['current_wallet'] <0)
										{
											echo "<tr><td align='center' colspan='6' >  Total Dues as on " . date('d-M-Y') .": <b>". abs($member['current_wallet']) ."</b> </td></tr>";
										}
										?>
										
										<tr>
											
											<td align='left' valign='top' colspan='6' > 
										
											<script> var words =toWords(<?php echo $invoice['net_payable']; ?>); document.write("<div class='t' style='text-transform:capitalize'><b>In Words : </b>"+words+" rupees only </div>"); </script>
											
											<b style='float:right'> <br><br><br> For <?php echo $inst_name; ?> </b>
											</td>
										</tr>
										<tr>
											
										<td align='center' colspan='6'  class='print1' > 
										<a href='transaction'> Back to New Invoice</a>
										
										|	<a href='index'> Back to Dashboard</a>
											
										</td>
										</tr>
									  
									</tfoot>
                                </table>
                                
                           
<?php include_once('footer.php'); ?>