<?php include('header.php');?>
<?php include('menu.php'); 
$data =decode($_GET['link']);
$invoice_id =$data['invoice_id'];
$invoice  = get_data('invoice_details',$invoice_id);
if($invoice['count']>0)
{
$cid =$invoice['data']['customer_id'];
$customer = get_data('customer_details',$cid)['data'];

?>
<style type="text/css">
@media print
{
body * { visibility: hidden; }
#printarea * { visibility: visible; }
#printarea { position: absolute; top: 10px; left: 10px; width:100%;height:700px; }
tbody{min-height:650px;}
td{border:solid 1px #d4d4d4;}
}
</style>
<script type="text/javascript" src="assets/js/towords.js"></script>
        <!--  page-wrapper -->
       <div class="content p-4">
				
<h2 class="mb-4">Invoice Details	</h2>
	<div class="card mb-4">
        <div class="card-body">
                               <table id ='printarea' class="table table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <td colspan='2'> 
                                            <b> Shop Details</b> <br>
                                            <?php echo $inst_name; ?> <br>
                                            <?php echo $inst_address1; ?> <br>
                                            <?php echo $inst_contact; ?> <br>
                                            <?php echo $inst_email; ?> <br>
                                            
                                            </td>
                                            
                                            <td colspan='3' align='right'> 
                                            <b> Customer Details</b> <br>
                                            <?php echo $customer['name']; ?> <br>
                                            <?php echo $customer['address']; ?> <br>
                                            <?php echo $customer['mobile']; ?> <br>
                                            <?php echo $customer['email']; ?> <br>
                                            </td>
                                        </tr>
                                        <tr bgcolor='#d5d5d5'>
                                              <td colspan='3'> Invoice No : 
                                              <?php echo $invoice_id; ?></td>
                                              <td colspan='2' align='right'> Date : <?php echo date('d-M-Y',strtotime( $customer['created_at'])); ?> </td>

                                        </tr>
                                        <tr>
                                            <th width='100px'>Sr. No.  </th>
                                            <th>Product  </th>
                                            <th>Rate </th>
                                            <th width='150px'>Quantity</th>
                                            <th  align='right' >Amount</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody valign='top'>
										<?php 
										$sql ="select * from order_details  where invoice_id ='$invoice_id' ";
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
										echo"<td>".$i."</td>";
										echo"<td>".$product['name']."</td>";
										echo"<td>".$row['rate']. "/" .$product['unit']."</td>";
										echo"<td>".$row['qty']. " " .$product['unit']."</td>";
										echo"<td align='right'>".$row['amount']."</td>";
										echo "</tr>";
										$i=$i+1;
										}
                                       ?>
                                     </tr> 
                                    </tbody>
									<tfoot class='text-right'>
										<tr>
									    <td align='left' colspan='4'> Total </td>
										<th> <?php echo $t; ?></th>
										</tr>
										
									    <tr><td colspan='5' style='text-transform:uppercase;'>
										   <script> var words =toWords(<?php echo $t; ?>); document.write("<div class='t'><b>In Words : </b>"+words+" rupees only </div>"); </script>
										   </td>
									   </tr>
									   </tfoot>
                                </table>
                            </div>
                            
                      
						</div>
						<div class="panel-footer">
                            <center> <a href='pi.php?p=<?php echo encode('invoice_id='.$invoice_id); ?>' class='btn btn-success btn-sm' target='_blank'  > PRINT </a> </center>
                        </div>

        </div>
        <!-- end page-wrapper -->
<?php } include_once('footer.php'); ?>