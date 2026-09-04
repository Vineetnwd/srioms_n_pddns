<?php 
include('header.php');
include('menu.php');
if(isset($_GET['scan_by']))
{
	$status = $_SESSION['status'] =$_GET['scan_by'];
}
else if(isset($_SESSION['status']))
{
	$status = $_SESSION['status'];
}
else{
	$status ='ACTIVE';
}

?>
<div class="content p-4">
	<div class='row'>
		<div class='col-9'>
		<h2 class="mb-4">Manage Products
		<button class='btn btn-primary btn-xs' onClick ='exportxls()'> Export </button>
		</h2>
		</div>
		<div class='col-3 text-right'>
		<form action ='' method='get'>
		<select name='scan_by' onChange='submit()' class='h2'>
			<?php dropdown($product_status_list,$status); ?>
		</select>
		</form>
		</div>
	</div>				
 
				
	<div class="card mb-4">
        <div class="card-header">
			<a href='add_product.php' class='active_block btn btn-warning btn-xs' >Add New</a>
			<span class='btn btn-info btn-xs'>
			<input type="checkbox" id="selectall" onClick="selectAll(this)" class='btn'/> Select All </span>
			<button class='active_block btn btn-success btn-xs' data-table='product' data-pkey='id'  data-status='ACTIVE'>ACTIVE</button>
			<button class='active_block btn btn-danger btn-xs' data-table='product' data-pkey='id'  data-status='PENDING'>PENDING</button>
			
		</div>
        <div class="card-body">
			<div class="row">
								
				<div class="col-lg-12">
								
								<!--    Basic Table  -->
								<table id="data_tbl" class="table table-hover" cellspacing="0" width="100%">
                                    <thead >
                                        <tr>
                                            <th>Photo</th>
                                            <th>Category</th>
                                            <th>Product</th>
                                            <th>MRP</th>
                                            <th>Card Discount</th>
                                            <th>Stock</th>
                                            <th>Expiry Date</th>
                                            <th>Status</th>
                                            <th>Operation</th>
                                        </tr>
										
                                    </thead>
                                    <tbody>
									<?php
									
									$res = get_all('product','*', array('status'=>$status));
									
									if($res['count']>0)
									{	
									foreach($res['data'] as $row)
									{
											echo "<tr>";
											$id=$row['id'];
											echo "<td> <img src='upload/". $row['photo']."' width='35' height='35x'></td>";
											echo "<td> ". $row['type']."</td>";
											echo "<td> ". $row['name']."</td>";
											echo "<td> ". $row['mrp']."/".$row['unit'] ."</td>";
											echo "<td> ". $row['card_discount'] ." % </td>";
											echo "<td> ". $row['stock'] ."</td>";
											echo "<td> ". date('d-M-Y', strtotime($row['expiry_date'])) ."</td>";
											echo "<td> ". $row['status'] ."</td>";
									?>
											<td align='right'>
											<input type='checkbox' value ='<?php echo $id; ?>' name='sel_id[]'  class='chk'>
											<a href='add_product?id=<?php echo $id; ?>' class=' btn btn-info btn-xs text-light' title='Edit'> <i class='fa fa-edit'></i> </a>
											<span class='delete_btn' data-table='product' data-id='<?php echo $id; ?>' data-pkey='id' title='Detete product Permanently'> <i class='fa fa-trash'></i> </span>
											</td>
											</tr>
									<?php
									}
									}
									?>
                                       
                                    </tbody>
                                </table>
                      </div>
                      </div>
                      </div>
    
                   
<?php require_once('footer.php'); ?>