<?php include('header.php');?>
<?php include('menu.php');
if(isset($_GET['link'])){
$data = decode($_GET['link']);
$member_id=$data['member_id'];
$member = get_data('member',$member_id)['data'];
$link =encode("member_id=".$member_id);
}
?>
<div class="content p-4">
        	
        <h2 class="mb-4">Wallet Transaction</h2>

		<div class="card mb-4">
        <div class="card-header bg-white font-weight-bold float-right">
			
           Wallet Transaction 
		   <?php if  (isset($member_id)){ echo "of " . $member['name']. " <span class='badge badge-primary'>".  $member['user_type']; } ?></span> 
		  <span class='float-right'>
			<a href='member_txn?link=<?php echo $link; ?>' target='_blank' class='btn btn-danger btn-sm'> Print </a>
		   <button id='btnExport' onclick='fnExcelReport();' class='btn btn-info btn-sm'  >Download Excel </button>
		   </span>
        </div>
        <div class="card-body">
        
                                 <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Txn Id</th>
                                            <th>Txn Date</th>
                                            <th>Membership Id</th>
                                            <th>Name</th>
                                            <th>Credit Amt  </th>
                                            <th>Debit Amt  </th>
                                            <th>Mode  </th>
                                            <th>Remarks  </th>
                                            <th>Balance </th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
										if(isset($member_id))
										{
											$sql ="select * from wallet where member_id ='$member_id' and  status ='SUCCESS'"; 
										}
										else{
											$sql ="select *  from wallet where status ='SUCCESS'"; 
										}
										
										$debit = $credit =0;
										
										
										$res = mysqli_query($con,$sql) or die ("Error in Txn Report ". mysqli_error($con));
										
										while($row =mysqli_fetch_array($res))
										{
										$debit =$debit + $row['debit_amt'];
										$credit =$credit + $row['credit_amt'];
										
										echo"<tr class='odd gradeX'>";
										echo"<td>".$row['id']."</td>";
										echo"<td>".date('d-M-Y',strtotime($row['txn_date']))."</td>";
										echo"<td>".get_data('member',$row['member_id'],'membership_id')['data']."</td>";
										echo"<td>".get_data('member',$row['member_id'],'name')['data']."</td>";
										echo"<td>".$row['credit_amt']."</td>";
										echo"<td>".$row['debit_amt']."</td>";
										echo"<td>".$row['txn_mode']."</td>";
										echo"<td>".$row['txn_remarks']."</td>";
										echo"<td align='right'>".$row['balance']."</td>";
                                        	
									    echo "</tr>";
										}
                                       ?>
                                     </tr> 
                                    </tbody>
									<tfoot>	
										<tr bgcolor='#d4d4d6'>
											<th colspan='4'>
												Total  
											</th>
											<th> <?php echo $credit; ?></th>
											<th> <?php echo $debit; ?></th>
											<td colspan='3' align='right'> Current Wallet : <?php echo $credit -$debit; ?></td>
										</tr>	
									</tfoot>
                                </table>
                            </div>
                            
                      
         <?php require_once('footer.php'); ?>