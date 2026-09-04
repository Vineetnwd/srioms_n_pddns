<?php include('header.php');?>
<?php include('menu.php');
if(isset($_GET['center_code']))
{
$center_code =$_GET['center_code'];
}
else{
    $center_code=$user_name;
}

?>
<div class="content p-4">
        	
        <h2 class="mb-4"> Transaction Details   </h2>

		<div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
          <?php echo centerid($center_code,'center_name'); ?>
		   
        </div>
        
        <div class="card-body">
        
                              <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Invoice No </th>
                                            <th>Date </th>
                                            <th>Back Dues </th>
                                            <th>Invoice Amount  </th>
                                            <th>Total  </th>
                                            <th>Payment </th>
                                            <th>Dues </th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php 
										$sql ="select * from invoice  where center_code ='$center_code' order by invoice_no desc"; 
										
										
										$res = mysqli_query($con,$sql) or die ("Error in Txn Report ". mysqli_error($con));
										
										while($row =mysqli_fetch_array($res))
										{
										$gtotal =$row['total'] + $row['prev_dues'];	
										echo"<tr class='odd gradeX'>";
										$tdate= $row['txn_date'];
										$inv_id= $row['inv_id'];
										$link =encode("inv_id=$inv_id&txn_date=$tdate&center_code=$center_code");
										echo"<td><a href='txn_history?link=$link'>".$row['invoice_no']."</a></td>";
										echo"<td>".date('d-M-Y ',strtotime($row['txn_date']) )."</td>";
										echo"<td>".$row['prev_dues']."</td>";
										echo"<td>".$row['total']."</td>";
										echo"<td><b>".$gtotal."<b></td>";
										echo"<td>".$row['payment']."</td>";
										echo"<td class='text-danger text-right'>".$row['dues']."</td>";
                                      
									  echo"</tr>";
										}
                                       ?>
                                     </tr> 
                                    </tbody>
                                </table>
                            </div>
                            
                      
            </div>

        </div>
<?php require_once('footer.php'); ?>