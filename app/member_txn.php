<?php include('function.php');
if(isset($_GET['link'])){
$data = decode($_GET['link']);
$member_id=$data['member_id'];
$member = get_data('member',$member_id)['data'];

}
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

                               <table  class="table table-hover" cellspacing="0" cellpadding='5px' width="750px" align='left' border='1' rules='rows' >
                                    <thead>
                                        <tr>
                                            <td style='border-right:none;text-align:center;' colspan='6'> 
                                           
											<img src='assets/img/logo.png' align='left' width='90px'>
											
											
                                            <h1 style='display:inline'><?php echo $inst_name; ?> </h1><br>
                                            A unit of <?php echo $managed_by; ?> <br>
                                            <?php echo $inst_address1. ", ". $inst_address2; ?> <br>
                                            <?php echo $inst_contact; ?> | <?php echo $inst_email; ?>
                                            <br> <?php echo $inst_url; ?>
                                            
                                            </td>
                                         </tr>
										 <tr>
                                            <th> Patient ID </th> 
                                            <th colspan='3'><?php echo $member['membership_id']; ?> </th>
											<th> Patient Type </th> 
                                            <th><?php echo $member['user_type']; ?> </th>
											
											
										</tr>
										<tr>
                                            <th> Name </th> 
                                            <th colspan='3'><?php echo $member['name']; ?> </th>
											<th> Mobile No. </th> 
                                            <th><?php echo $member['mobile']; ?> </th>
										</tr>
										<tr>
                                            <td> Address </td> 
                                            <td colspan='3'><?php echo $member['address']; ?> </td>
											<td> Gender </td>
                                            <td><?php echo $member['gender']; ?> </b> </td>
                                          
										</tr>
										<tr>
											<td> D.O.B </td>
                                            <td colspan='3'><?php echo date('d-M-Y',strtotime($member['date_of_birth'])); ?> </td>
											<td> Date of Joining </td> 
                                            <td><?php echo $member['joining_date']; ?> </td>
											
                                        </tr>
                                    
                                        <tr bgcolor='#d4d4f2'>
                                            <th>Txn Date</th>
                                            <th>Credit Amt  </th>
                                            <th>Debit Amt  </th>
                                            <th align='left'>Mode  </th>
                                            <th align='left'>Remarks  </th>
                                            <th align='right'>Balance </th>
                                         </tr>
                                    </thead>
                                    <tbody>
										<?php 
											$sql ="select * from wallet where member_id ='$member_id' and  status ='SUCCESS'"; 
										
										$t =0;
										$p =0;
										$d=0;
										
										$res = mysqli_query($con,$sql) or die ("Error in Txn Report ". mysqli_error($con));
										
										if(mysqli_num_rows($res)>0)
										{
										while($row =mysqli_fetch_array($res))
										{
										
										echo"<tr class='odd gradeX'>";
									//	echo"<td>".$row['id']."</td>";
										echo"<td>".date('d-M-Y',strtotime($row['txn_date']))."</td>";
										echo"<td>".$row['credit_amt']."</td>";
										echo"<td>".$row['debit_amt']."</td>";
										echo"<td>".$row['txn_mode']."</td>";
										echo"<td>".$row['txn_remarks']."</td>";
										echo"<td align='right'>".$row['balance']."</td>";
                                        	
									    echo "</tr>";
										}
										}
										else{
											echo"<tr class='odd gradeX'>";
											echo"<td height='100px' valign='middle'> No Transaction Found</td></tr>";
										}
                                       ?>
                                     </tr> 
                                    </tbody>
									<tfoot>
									<?php if($member['current_wallet'] <0)
										{
											echo "<tr><th align='center' colspan='6' >  Current Wallet Balance " . date('d-M-Y') .": <b>". $member['current_wallet'] ."</b> </th></tr>";
										}
										?>
									 <tr bgcolor='#d4d4f2'>
                                            <th colspan='4' align='left'>
												This is computer Generated Copy hence Sigature not required.<br>
												Generated at : <?php echo date('d-M-Y h:i:s A'); ?><br>
												Generated By : <?php echo get_data('user',$_SESSION['user_id'],'user_name','user_id')['data']; ?><br>
										<th>
										<th colspan='' align='right'><br><br>
										For <?php echo $inst_name; ?>
										</th>
									 </tr>
									<tr>
											
										<td align='center' colspan='6'  class='print1' > 
											<a href='transaction'> Back to New Invoice</a> |
											<a href='index'> Back to Dashboard</a>
										</td>
										</tr>
									</tfoot>
                                </table>
                            </div>
                            
                      
         <?php require_once('footer.php'); ?>