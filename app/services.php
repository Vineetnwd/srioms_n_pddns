<?php 
include('header.php');
include('menu.php');
if(isset($_GET['id']))
{
	$data  = get_data('services',$_GET['id'])['data'];
	extract($data);
}
else{
	$res1  =insert_row('services');
	$id1 = $res1['id'];
	$data  = get_data('services',$id1)['data'];
	extract($data);
}
?>
<div class="content p-4">
				
 <h2 class="mb-4">Manage Services	</h2>
				
	<div class="card mb-4">
	   <div class='card-header '>
			Add New Services 
			<div class='float-right'>
	        <?php if($user_type=='Admin'){?>	
					<span class='btn btn-info btn-xs'>
					<input type="checkbox" id="selectall" onClick="selectAll(this)" class='btn'/> Select All
					</span>
					<button class='active_block btn btn-success btn-xs' data-table ='services' data-status='ACTIVE' >ACTIVE</button>
					<button class='active_block btn btn-secondary btn-xs' data-table ='services'  data-status='BLOCK' >BLOCK</button>
					<button class='status_btn btn btn-danger btn-xs' data-table ='services'  data-status='DELETE'>DELETE </button>
			<?php } ?>
			</div>
	   </div>
        <div class="card-body">
			<div class="row">
                <div class="col-md-4" >
                    <!-- Form Elements -->
                    	<form action ='add_services' id='update_frm' enctype='multipart/form-data'>
						
						<div class="form-group">
                            <label>Service Name</label>
                            
                            <input class="form-control" value='<?php echo $id; ?>' name='id' type='hidden' required  >
                            <input class="form-control" value='<?php echo $name; ?>' name='name'  required  >
                            
                            <input class="form-control" type='hidden' name='photo' id='targetimg' value='<?php echo $photo; ?>'  required  >
                        </div>
                    	<div class="form-group">
                            <label>Service Charge (in Rs.)</label>
							<input class="form-control" type='number' name='fee' value='<?php echo $fee; ?>'  required  >
                        </div>
                        
                        <div class="form-group">
                            <label class='text-danger'>Card Holder's Discount (in %)</label>
							<input class="form-control" type='number' name='card_discount' value='<?php echo $card_discount; ?>'  required  >
                        </div>
                    	
						<div class="form-group">
                                            <label>Service Status</label>
                                            <select class="form-control" name='status' required>
												<?php dropdown($status_list,$status); ?>
                                            </select>
                                      </div>
						</form>	
						<form id='uploadForm' enctype= 'multipart/form-data'>
							<div class="form-group">
								<label>Service Image </label>
								<input type='file' name='uploadimg' id='uploadimg' accept='image' class='form-control'>
							</div>
							<img src='upload/<?php echo $photo; ?>' width='100px'  height='100px' id='display'  class='img-thumbnail d-self-centered'> 
							<p> Aspect Ratio 1X1 </p>
						</form>
						
					</div>	
					 
				
				<div class="col-lg-8">
								
								<!--    Basic Table  -->
                     <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Fee</th>
                                            <th>Discount</th>
                                            <th>Image </th>
                                            <th>Status</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$i=1;
									$query ="select * from services where status <>'AUTO' order by id desc";
									$res = mysqli_query($con,$query) or die(" Default Error : ".mysqli_error($con));
									while($row =mysqli_fetch_array($res))
									{
									
									    $id=$row['id'];
											echo "<tr>";
											echo "<td> ". $i ."</td>";
											echo "<td> ". $row['name'] ."</td>";
											echo "<td> ". $row['fee'] ."</td>";
											echo "<td> ". $row['card_discount'] ."% </td>";
											echo "<td> <img src='upload/". $row['photo'] ."' height='60px'> </td>";
											echo "<td> ". $row['status'] ."</td>";
									?>
										<td align='right'>
									    <input type='checkbox' value ='<?php echo $id; ?>' name='sel_id[]' class='chk'>
											<a href='services?id=<?php echo $id; ?>'><i class='fa fa-edit btn btn-warning btn-xs'></i></a>
											<span class='delete_btn' data-table='services' data-id='<?php echo $id; ?>' data-pkey='id' title='Detete Service Permanently'> <i class='fa fa-trash'></i> </span>
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
