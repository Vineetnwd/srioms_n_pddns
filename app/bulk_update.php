<?php require_once('header.php'); ?>
<?php require_once('menu.php'); ?>
<div class="content p-4">
        	
        <h2 class="mb-4">Bulk Action </h2>
		<div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
           Update Price and Stock
        </div>
        <div class="card-body">
			<?php if(isset($_GET['msg'])){
			
			   echo "<div class ='alert alert-info'> ". $_GET['msg'] ."</div>";
		   }
		   ?>
			<div class='row'>
				<div class="col-lg-3">
				<form action='master_process?task=bulk_import' method='post' enctype="multipart/form-data">
					<div class="form-group pt-1 text-right">
						<label class="control-label" for="inputSuccess">Select CSV File </label>
						<input type="hidden" class='form-control' name='table' value='product_details'>
						<input type="hidden" class='form-control' name='pkey' value='id' >
					</div>
				</div>
                
				<div class="col-lg-4">
					<div class="form-group">
						<div class="form-group has-success">
							<input type="file" name='file' class='form-control' required >
						</div>
					</div>
				</div>
				<div class="col-lg-2">
					<div class="form-group">
						<label  class="control-label" >&nbsp;</label>
						<button type="submit" class='btn btn-success btn-md'> <i class='fa fa-upload'></i>  Upload New Data </button>
					</div>
				</form>
				</div>
				
				<div class="col-lg-3 text-center">
						<a href='master_process?task=bulk_export&table=product_details' class='btn btn-danger btn-md'> <i class='fa fa-download'></i> All Data </a>
						<a href='master_process?task=bulk_export&table=product_details&col_name=stock' class='btn btn-info btn-md'> <i class='fa fa-download'></i> Price & Stock </a>
				</div>
			</div>	
				
						
				
			</div>
        </div>
				
				
	</div>
</div>
</div>
 <?php echo require_once('footer.php'); ?>