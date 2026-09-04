<?php
include('conn.php');
$inv_id =$_POST['inv_id'];
$quantity =$_POST['quantity'];
$rate =$_POST['rate'];
$center_code =$_POST['center_code'];
$invoice_no =$_POST['invoice_no'];
$amount =$_POST['amount'];
//$payment =$_POST['payment'];
//$dues =$_POST['dues'];
$txn_remarks = $_POST['txn_remarks'];
$txn_date = $_POST['txn_date'];

$status ="invoice_no=$invoice_no&center_code=$center_code&txn_date=$txn_date&status=success";


$sql = "INSERT INTO txn( inv_id,  txn_remarks, quantity, rate, amount ) 
VALUES ('$inv_id', '$txn_remarks', '$quantity', '$rate', '$amount')";

mysqli_query($con,$sql) or die(" Material Txn Entry Error : ".mysqli_error($con));

$sql2 = "update invoice set  invoice_no ='$invoice_no' , txn_date ='$txn_date',center_code ='$center_code' where inv_id ='$inv_id'"; 

mysqli_query($con,$sql2) or die(" Invoice No and Date update Error : ".mysqli_error($con));


?>

<script> window.location ='txn_entry.php?<?php echo $status; ?>' ; </script>