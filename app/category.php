<?php 
include('header.php');
include('menu.php');
if(isset($_GET['id']))
{
	$data  = get_data('category',$_GET['id'])['data'];
	extract($data);
}
else{
	$res1  =insert_row('category');
	$id1 = $res1['id'];
	$data  = get_data('category',$id1)['data'];
	extract($data);
}
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
<div class="content p-4">
				
 <h2 class="mb-4">Manage Category Details	</h2>
				
	<div class="card mb-4">
	   <div class='card-header'>
	        <?php if($user_type=='ADMIN'){?>	
										<tr>
										<td colspan='8' align='center'>
										<span class='btn btn-info btn-xs'>
										<input type="checkbox" id="selectall" onClick="selectAll(this)" class='btn'/> Select All
										</span>
										<button class='status_btn btn btn-success btn-xs' data-table ='category' data-status='ACTIVE' >ACTIVE</button>
										<button class='status_btn btn btn-secondary btn-xs' data-table ='category'  data-status='BLOCK' >BLOCK</button>
										<button class='status_btn btn btn-danger btn-xs' data-table ='category'  data-status='DELETE'>DELETE </button>
										</td>
									    </tr>
			<?php } ?>
	   </div>
        <div class="card-body">
			<div class="row">
                <div class="col-md-4" >
                    <!-- Form Elements -->
                    	<form action ='add_category' id='update_frm' enctype='multipart/form-data'>
						
						<div class="form-group">
                            <label>Category Name</label>
                            
                            <input class="form-control" value='<?php echo $id; ?>' name='id' type='hidden' required  >
                            <input class="form-control" value='<?php echo $name; ?>' name='name'  required  >
                            
                            <input class="form-control" type='hidden' name='photo' id='targetimg' value='<?php echo $photo; ?>'  required  >
                        </div>
                        
                        <div class="form-group">
                            <label>Parent Category</label>
                            <select name='parent' class='form-control'>
                                <option value=''>No Parent</option>
                                <?php dropdownlist('category','id','name',$parent); ?>
                            </select>
                            
                        </div>
						
						<div class="form-group">
                                            <label>Category Status</label>
                                            <select class="form-control" name='status' required>
												<?php dropdown($status_list,$status); ?>
                                            </select>
                                      </div>
						</form>	
						<form id='uploadForm' enctype= 'multipart/form-data'>
							<div class="form-group">
								<label>Category Image </label>
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
                                            <th>Parent</th>
                                            <th>Name</th>
                                            <th>Image </th>
                                            <th>Count </th>
                                            <th>Status</th>
                                            <th>Operation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$query ="select * from category where status <>'AUTO' order by id desc";
									$res = mysqli_query($con,$query) or die(" Default Error : ".mysqli_error($con));
									while($row =mysqli_fetch_array($res))
									{
									    $id=$row['id'];
									    
									    $ct = get_all('product_details','*',array('category_id'=>$id))['count'];
									    
									    $prt = get_data('category',$row['parent'],'name')['data'];
									    
											echo "<tr>";
											echo "<td> ". $id ."</td>";
											echo "<td> ". $prt ."</td>";
											echo "<td> ". $row['name'] ."</td>";
											echo "<td> <img src='upload/". $row['photo'] ."' height='60px'> </td>";
											echo "<td> ". $ct ."</td>";	
											echo "<td> ". $row['status'] ."</td>";
									?>
										<td align='right'>
									    <input type='checkbox' value ='$id' name='sel_id[]' class='chk'>
											<a href='category?id=<?php echo $id; ?>'><i class='fa fa-edit btn btn-warning btn-xs'></i></a>
											<span class='delete_btn' data-table='category' data-id='<?php echo $id; ?>' data-pkey='id' title='Detete Category Permanently'> <i class='fa fa-trash'></i> </span>
											</td>
											</tr>
									<?php
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
