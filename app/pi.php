<?php include('function.php');
$data =decode($_GET['p']);
$invoice_id =$data['invoice_id'];
$invoice  = get_data('invoice_details',$invoice_id);

if($invoice['count']>0)
{
$cid =$invoice['data']['customer_id'];
$customer = get_data('customer_details',$cid)['data'];

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

</style>
<script type="text/javascript" src="assets/js/towords.js"></script>


                               <table  class="table table-hover" cellspacing="0" cellpadding='3px' width="200px" align='left' rules='none' border='0'>
                                    <thead>
                                        <tr>
                                            <td colspan='3' align='center'> 
                                           
											<img src='assets/img/logo.png' align='center' width='90px'><br>
											<b><?php echo $inst_name; ?> <br></b>
                                            <?php echo $inst_address2; ?> <br>
                                            <?php echo $inst_contact; ?> <br>
                                            </td>
                                        </tr>
										<tr>
                                            <td colspan='3' > 
                                            <b> Customer Details</b> <br>
                                            <?php echo $customer['name']; ?> <br>
                                            <?php echo $customer['address']; ?> <br>
                                            <?php echo $customer['mobile']; ?> <br>
                                            <?php echo $customer['email']; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                        <td colspan='3'> Inv No : #<?php echo $invoice_id; ?></td>
                                        </tr>
                                        <tr>
										<td colspan='3' >Order At: <?php echo date('d-M-Y h :i A', strtotime($invoice['data']['created_at'])); ?> </td>
                                        </tr>
										<tr>
											 <th colspan='3' > <hr> Name of Product </th>
                                        </tr>
                                        <tr>
											<th>Quantity</th>
                                            <th>Rate </th>
                                            <th  align='right' >Amount </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody valign='top'>
									
										<?php 
										$sql ="select * from order_details  where invoice_id ='$invoice_id' "; //center_code='$center_code' and txn_date='$txn_date'"; 
										$t =0;
										$p =0;
										$d=0;
										$i=1;
										$res = mysqli_query($con,$sql) or die ("Error in Txn Report ". mysqli_error($con));
										while($row =mysqli_fetch_array($res))
										{
											$product = get_data('product_details',$row['product_id'])['data'];
											
										$t =$t +$row['amount'];	
										echo"<tr class='odd gradeX'>";
										echo"<td colspan='3'><b>".$i. " : ". $product['name']."</b></td></tr>";
										echo"<tr><td>".$row['qty']."</td>";
										echo"<td>".$row['rate']. "/" .$product['unit']."</td>";
										echo"<td align='right'>".$row['amount']."</td>";
										echo "</tr>";
										$i=$i+1;
										} 
                                       ?>
									
                                    </tbody>
									<tfoot class='text-right'>
										<?php
										if($t<$min_purchase)
										{
											$t = $t+$d_charge;
											echo "<tr> <td colspan='3'> Delivery Charge </td><td>30</td></tr>";
										}
										?>
										<tr>
											<th align='right' valign='top' colspan='3' > <hr> Total : <?php echo $t; ?></th>
										</tr>
										<tr>
											<td colspan='3'>
											<script> var words =toWords(<?php echo $t; ?>); document.write("<div class='t'><b>In Words : </b>"+words+" rupees only </div>"); </script>
											<br><br><br>
											<b> For <?php echo $inst_name;?></b>
											</td>
										</tr>
										
									  
									</tfoot>
                                </table>
                           
<?php } include_once('footer.php'); ?>