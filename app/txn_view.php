<?php include('header.php');?>
<?php include('menu.php');?>
<div class="content p-4">
        	
        <h2 class="mb-4">View Transaction</h2>

		<div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
           Manage Transaction Details <button id='btnExport' onclick='fnExcelReport();' class='btn btn-info btn-sm' style="float:right" >Download Excel </button>
		  
        </div>
        <div class="card-body">
        
                                 <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Center Code</th>
                                            <th>Center Name</th>
                                            <th>Total  </th>
                                            <th>Payment </th>
                                            <th>Dues </th>
											<th>Operation.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
										$sql ="select center_code, sum(total) ,sum(payment),sum(dues) from invoice group by center_code"; 
										$t =0;
										$p =0;
										$d=0;
										
										$res = mysqli_query($con,$sql) or die ("Error in Txn Report ". mysql_error());
										
										while($row =mysqli_fetch_array($res))
										{
										$t =$t +$row['sum(total)'];	
										$p =$p +$row['sum(payment)'];	
										$dues =$row['sum(total)']-$row['sum(payment)'];
										$d =$d +$dues;
										echo"<tr class='odd gradeX'>";
										$center =$row['center_code'];
										echo"<td>".$center."</td>";
										echo"<td><a href='user_txn.php?center_code=$center' title='Click to View Transactions'>".centerid($center,'center_name')."</a></td>";
										
										echo"<td>".$row['sum(total)']."</td>";
										echo"<td>".$row['sum(payment)']."</td>";
										echo"<td>".$dues."</td>";
                                        echo"<td width='55'>";
										echo "<a href='txn_entry.php?center_code=$center&action=txn' title='Click to Entry New Transactions ' >
										<button type='submit' class='btn btn-info btn-xs' name='Pay_fee'> Txn Entry</button></a>";	
									    echo "</td></tr>";
										}
                                       ?>
                                     </tr> 
                                    </tbody>
									<tfoot>
										<tr>
										<td colspan='2'> Total </td>
										<th> <?php echo $t; ?></th>
										<th> <?php echo $p; ?></th>
										<th> <?php echo $d; ?></th>
										<td> &nbsp;</td>
										</tr>
									</tfoot>
                                </table>
                            </div>
                            
                      
         <?php require_once('footer.php'); ?>