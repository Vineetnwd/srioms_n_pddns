<?php 
include('header.php');
include('menu.php');

if(isset($_GET['id']))
{
	$data  = get_data('product',$_GET['id'])['data'];
	extract($data);
}
else{
	$res1  =insert_row('product');
	$id1 = $res1['id'];
	$data  = get_data('product',$id1)['data'];
	extract($data);
}
if(isset($_GET['unit']))
{
	$unit  = $_GET['unit'];
}
else if(isset($_SESSION['unit']))
{
	$unit  = $_SESSION['unit'];
}
else{
    $unit  = null;
}
?>
<div class="content p-4">

	<div class='row'>
		<div class='col-6'>
		<h2 class="mb-4">Product Details
		</h2>
		</div>
		<div class='col-6 text-right'>
		<a href='manage_product.php' class='btn btn-danger btn-xs' > Manage Product </a>
		</div>
	</div>
	<div class="card mb-4">
        <div class="card-body">
		<form action ='add_product' id='update_frm' enctype='multipart/form-data'>
			<div class="row">
			
					<div class="col-md-4" >
                    
                    	
						<div class="form-group">
								<label>Product Type</label>
								<select class="form-control" name='type' required>
								<?php dropdown($product_type_list, $type); ?>
								</select>
						</div>
						<div class="form-group">
                            <label>Product / Service Name</label>
                            <input class="form-control" type='hidden' value='<?php echo $id; ?>' name='id'  required  >
                            <input class="form-control" value='<?php echo $name; ?>' name='name'  required  >
                        </div>
						
						<div class="form-group">
                            <label>Salt Name (For Medicine Only)</label>
                            
                            <input class="form-control" value='<?php echo $salt_name; ?>' name='salt_name'   >
                        </div>
						
						<div class="form-group">
                            <label>Details (About Product) </label>
                            <textarea class="form-control" name='details' rows='3' ><?php echo $details; ?></textarea>
                        </div>
						<div class="form-group">
                            <label>Expiry Date</label>
                            <input class="form-control" value='<?php echo $expiry_date; ?>' name='expiry_date'   type='date'>
                        </div>
						
					</div>
					<div class="col-md-4" >
						<div class="form-group">
                            <label>Rate / Service Charge </label>
                            <input class="form-control" value='<?php echo $mrp; ?>' name='mrp'  required  >
                        </div>
						
						<div class="form-group">
                            <label class='text-danger'>Card Discount (in %)</label>
                            <input class="form-control" value='<?php echo $card_discount; ?>' name='card_discount' type='number' >
                        </div>
						
						<div class="form-group">
								<label>Unit</label>
								<select class="form-control" name='unit' required>
								<?php dropdown($unit_list, $unit); ?>
									
								</select>
						</div>
						
						<div class="form-group">
                            <label>Opening Stock </label>
                            <input class="form-control" value='<?php echo $stock; ?>' name='stock'  required  >
                        </div>
					
						
						<div class="form-group">
								<label>Status</label>
								<select class="form-control" name='status' required>
									<?php dropdown($product_status_list, $status); ?>
								</select>
						</div>
					</div>
					<div class="col-md-4" >	
						<input type="hidden" name='photo' id='targetimg' value='<?php echo $photo; ?>' >
						</form>	
						
						<div class="form-group">
							<label>Upload Photograph  </label>
							<input type='file' id='uploadimg' accept='image' class='form-control' >
						</div>
						
						<img src='upload/<?php echo $photo; ?>' width='200px'  height='100px' id='display'  class='img-thumbnail d-self-centered'> 
						<p> Aspect Ratio 2X1 </p>
						
					</div>	
				      </div>
                      </div>
        <div class="card-footer bg-white">
            <button class="btn btn-danger" id='update_btn'>Save Product</button>
        </div>
                   
<?php require_once('footer.php'); ?>