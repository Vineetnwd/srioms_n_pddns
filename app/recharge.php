<?php 
include('header.php');
include('menu.php');
if(isset($_GET['id']))
{
	$data  = get_data('recharge',$_GET['id'])['data'];
	extract($data);
}
else{
	$res1  =insert_row('recharge');
	$id1 = $res1['id'];
	$data  = get_data('recharge',$id1)['data'];
	extract($data);
}
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
<div class="content p-4">
				
 <h2 class="mb-4">Manage Recharge	</h2>
				
	<div class="card mb-4">
	   <div class='card-header '>
			Add New Recharge 
			<div class='float-right'>
	        <?php if($user_type=='Admin'){?>	
					<span class='btn btn-info btn-xs'>
					<input type="checkbox" id="selectall" onClick="selectAll(this)" class='btn'/> Select All
					</span>
					<button class='active_block btn btn-success btn-xs' data-table ='recharge' data-status='ACTIVE' >ACTIVE</button>
					<button class='active_block btn btn-secondary btn-xs' data-table ='recharge'  data-status='BLOCK' >BLOCK</button>
					<button class='status_btn btn btn-danger btn-xs' data-table ='recharge'  data-status='DELETE'>DELETE </button>
			<?php } ?>
			</div>
	   </div>
        <div class="card-body">
			<div class="row">
                <div class="col-md-4" >
                    <!-- Form Elements -->
                    	<form action ='add_recharge' id='update_frm' enctype='multipart/form-data'>
						
						<div class="form-group">
                            <label>Recharge Name</label>
                            
                            <input class="form-control" value='<?php echo $id; ?>' name='id' type='hidden' required  >
                            <input class="form-control" value='<?php echo $name; ?>' name='name'  required  >
                            
                        </div>
                    	<div class="form-group">
                            <label>Amount</label>
							<input class="form-control" type='number' name='amount' value='<?php echo $amount; ?>'  required  >
                        </div>
                        
                        <div class="form-group">
                            <label>Wallet Value</label>
							<input class="form-control" type='number' name='wallet' value='<?php echo $wallet; ?>'  required  >
                        </div>
                        
                        <div class="form-group">
                            <label>Validity (in Month)</label>
							<select name='validity' class="form-control" >
							    <?php dropdown( $validity_list); ?>
							</select>
                        </div>
                        
                        <div class="form-group">
                            <label>Details </label>
							<textarea class="form-control"  name='details' ><?php echo $details; ?></textarea>
                        </div>
						<div class="form-group">
                            <label>Service Status</label>
                            <select class="form-control" name='status' required>
								<?php dropdown($status_list,$status); ?>
                            </select>
                        </div>
						</form>	
					</div>	
					 
				
				<div class="col-lg-8">
								
								<!--    Basic Table  -->
                     <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Amount</th>
                                            <th>Wallet Value</th>
                                            <th>Validity </th>
                                            <th>Details</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$i=1;
									$query ="select * from recharge where status <>'AUTO' order by id desc";
									$res = mysqli_query($con,$query) or die(" Default Error : ".mysqli_error($con));
									while($row =mysqli_fetch_array($res))
									{
									
									    $id=$row['id'];
											echo "<tr>";
											echo "<td> ". $i ."</td>";
											echo "<td> ". $row['name'] ."</td>";
										echo "<td> ". $row['amount'] ."</td>";
										echo "<td> ". $row['wallet'] ."</td>";
										echo "<td> ". $row['validity'] ." Months </td>";
										echo "<td> ". $row['status'] ."</td>";
									?>
										<td align='right'>
									    <input type='checkbox' value ='<?php echo $id; ?>' name='sel_id[]' class='chk'>
											<a href='recharge?id=<?php echo $id; ?>'><i class='fa fa-edit btn btn-warning btn-xs'></i></a>
											<span class='delete_btn' data-table='recharge' data-id='<?php echo $id; ?>' data-pkey='id' title='Detete Service Permanently'> <i class='fa fa-trash'></i> </span>
											</td>
											</tr>
									<?php
									    $i++;
									}
									?>
                                       
                                    </tbody>
                                </table>
                      </div>
                      </div>
                      </div>
        <div class="card-footer bg-white">
            <button class="btn btn-danger" id='update_btn'>Save </button>
        </div>
                   
<?php require_once('footer.php'); ?>

	<script>
        $('.ls-modal').on('click', function(e){
		  e.preventDefault();
		  $('#appmodal').modal('show');
		  
		  $("#center_id").val($(this).attr("data-center"));
		  $("#center_code").val($(this).attr("data-code"));
		});
	</script>	
