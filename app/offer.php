<?php 
include('header.php');
include('menu.php');
if(isset($_GET['id']))
{
	$data  = get_data('offer',$_GET['id'])['data'];
	extract($data);
}
else{
	$res1  =insert_row('offer');
	$id1 = $res1['id'];
	$data  = get_data('offer',$id1)['data'];
	extract($data);
}
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css" rel="stylesheet">
<div class="content p-4">
				
 <h2 class="mb-4">Manage Offer	</h2>
				
	<div class="card mb-4">
        <div class="card-body">
			<div class="row">
                <div class="col-md-4" >
                    <!-- Form Elements -->
                    	<form action ='add_offer' id='update_frm' enctype='multipart/form-data'>
						
						<div class="form-group">
                            <label>Offer Title </label>
                            
                            <input class="form-control" value='<?php echo $id; ?>' name='id' type='hidden' required  >
                            <input class="form-control" value='<?php echo $name; ?>' name='name'  required  >
                            <input class="form-control" type='hidden' name='photo' id='targetimg' value='<?php echo $photo; ?>'  required  >
                        </div>
						<div class="form-group">
                            <label>Offer Details </label>
                            
                            <textarea class="form-control" name='details' ><?php echo $details; ?></textarea>
                           
                        </div>
						
						<div class="form-group">
                                            <label>Offer Status</label>
                                            <select class="form-control" name='status' required>
                                                <option value='SHOW'>SHOW</option>
                                                <option value='HIDE'>HIDE</option>
                                            </select>
                                      </div>
						</form>	
						<form id='uploadForm' enctype= 'multipart/form-data'>
							<div class="form-group">
								<label>Offer Image </label>
								<input type='file' name='uploadimg' id='uploadimg' accept='image' class='form-control'>
							</div>
							<div id='display'>
							<?php if ($photo !=""){?>
							<img src='upload/<?php echo $photo; ?>' height='100px'>
							<?php } ?>
							</div>
						</form>
						
					</div>	
					 
				
				<div class="col-lg-8">
								
								<!--    Basic Table  -->
                     <table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            
                                            <th>Title</th>
                                            <th>Image </th>
                                            <th>Status</th>
                                            <th>Operation</th>
                                             
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$query ="select * from offer where status <>'AUTO' order by id desc";
									$res = mysqli_query($con,$query) or die(" Default Error : ".mysqli_error($con));
									while($row =mysqli_fetch_array($res))
									{
											echo "<tr>";
											$id=$row['id'];
											echo "<td> ". $row['name'] ."</td>";
											//echo "<td>". $row['notice_details'] ."</td>";
											if ($row['photo'] =="")
											{
											echo "<td> NO Image </td>";
											}
											else {
											echo "<td> <img src='upload/". $row['photo'] ."' height='60px'> </td>";
											}
											echo "<td> ". $row['status'] ."</td>";
									?>
											<td align='right'>
											<a href='offer?id=<?php echo $id; ?>'><i class='fa fa-edit btn btn-warning btn-xs'></i></a>
											<span class='delete_btn' data-table='offer' data-id='<?php echo $id; ?>' data-pkey='id' title='Detete Offer Permanently'> <i class='fa fa-trash'></i> </span>
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
