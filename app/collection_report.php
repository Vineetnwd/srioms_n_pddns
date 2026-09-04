<?php include('header.php');?>
<?php include('menu.php');?>

 <div class="content p-4">
        <div class='row'>
			<div class='col-md-4'>
				<h2 class="mb-4">Collection Report </h2>
			</div>	
			<div class='col-md-8'>
					<form action='#' method='post'>
						<div class="row text-center">
						<div class="col-lg-4">
							<div class="form-group">
								<label></label>
								<input type='date' value='<?php echo date('Y-m-d');?>' name='from_date' class='h2' title='From Date' >
							</div>
						</div>
						
						 <div class="col-lg-4">
							<div class="form-group">
								<label></label>
								<input type='date' value='<?php echo date('Y-m-d');?>' name='to_date' class='h2' title='To Date'>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<input type="submit" class="btn btn-lg btn-success btn-sm" name='submit' value='Generate Report' >
							</div>
						</div>
						</div>
					</form>
			</div>
        </div>
				<?php if(isset($_POST['submit']) && isset($_POST['from_date']) )
									{
						$fromdate =$_POST['from_date'];
						$todate =$_POST['to_date'];
				?>					
		<div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
                        
            Collection from <b> <?php echo date('d-M-Y',strtotime($fromdate)); ?></b> to <b><?php echo date('d-M-Y',strtotime($todate)); ?></b>
            <button id='btnExport' onclick='fnExcelReport();' class='btn btn-info btn-sm' title='Download Excel' style="float:right"><i class='fa fa-file-excel-o'></i></button>
        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="data_tbl">
                                    <thead >
                                        <tr>
                                            <th >Receipt Id</th>
											<th>Invoice date</th>
                                            <th> Name</th>
                                            <th> Bill Amount</th>
                                            <th> Discount</th>
                                            <th> Net Payable</th>
                                            <th> Cash</th>
                                            <th> Bank</th>
                                            <th> Wallet</th>
                                            
                                            <th>Txn Remarks</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$cash =$wallet =$bank =0;
									
									$query ="SELECT * FROM invoice WHERE invoice_date between '$fromdate' and '$todate' ";
									
								//	$query ="select * from receipt where paid_date between '$fromdate' and '$todate' order by receipt_id desc";
										
									$res = mysqli_query( $con,$query) or die(" Default Error : ".mysqli_error($con));
									while($row =mysqli_fetch_array($res))
									{
									$rid = $row['id'];
									
									$cash =$cash +$row['cash'];
									$bank =$bank +$row['bank'];
									$wallet =$wallet +$row['wallet'];
									
									$link = encode('invoice_id='.$rid);
									echo"<tr class='odd gradeX'>";
									echo "<td><a href='print_invoice.php?link=".$link."' target='_blank' >". $row['invoice_no']."</a></td>";
									echo "<td> ". date('d-M-Y',strtotime($row['invoice_date'])) ."</td>";
									
									echo "<td> ". get_data('member',$row['member_id'],'name')['data'] ."</td>";
								
									echo "<td> ". $row['bill_amount'] ."</td>";
									echo "<td> ". $row['discount'] ."</td>";
									echo "<td> ". $row['net_payable'] ."</td>";
									echo "<td align='right'> ". $row['cash'] ."</td>";
									echo "<td align='right'> ". $row['bank'] ."</td>";
									echo "<td align='right'> ". $row['wallet'] ."</td>";
									echo "<td> ". $row['txn_remarks'] ."</td>";
											
									echo "</tr>";
									
									}
									
									?>
									</tbody>
									<tfoot>
                                    <tr  bgcolor='cyan'> 
										<td colspan='6' align='right'> Total </td>
										<td align='right'> <?php echo $cash; ?></td>
										<td align='right'> <?php echo $bank; ?></td>
										<td align='right'> <?php echo $wallet; ?></td>
										<td> </td>
										
									</tr>   
                                    </tfoot>
                                </table>
								<?php } ?>
                            </div>
                            </div>
                        </div>
  
<?php require_once('footer.php'); ?>