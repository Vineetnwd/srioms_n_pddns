<?php
session_start(); 
$token = session_id();
ini_set('max_execution_time', 300);
set_time_limit(300);
date_default_timezone_set('Asia/Kolkata');
$today = date("y-m-d");
$ctime = date('Y-m-d h:i:s');
/*-------Some Basic Details (Global Variables) ---------*/
if(isset($_SESSION['user_id']))
{
	$user_id = $_SESSION['user_id'];
}

$inst_name ="SHRI RAM Institute of Medical Sciences";
$managed_by ="SHRI RAM Institute of Medical Sciences";
$inst_address1 ="Shri Ram MRI Scan Center, Fatehpur Bypass Road";
$inst_address2 ="Siwan 841226 (Bihar)";
$inst_contact ="9934402822";
$inst_email ="info@srioms.co.in";
//$inst_email ="myofferplant@gmail.com";
$inst_logo ="assets/img/logo.png";
$white_logo ="assets/img/white_logo.png";
$inst_url ="https://srioms.co.in";
$app_link = "https://bit.ly/brimsapp";
$inst_domain ="srioms.co.in";
$inst_type ="Institute";
$sender_id ="OFFSMS";
$noreply_email ="noreply@srioms.co.in";
$auth_key_sms ="225858ASqpNTl65b4822ae"; // sms91 brims
$dlt ="1007161789213385513";



$gst ="10AAHCB7902J1ZX";
$cin ="U74999BR2018PTC037924";
$upi = "offerplant@upi";
$app_name ='SRIOMS';
$app_version ='1.0';
$base_url ='';
$d_charge=10;
$min_purchase=50;
/*---------Social Link ----------*/

$facebook ='http://facebook.com/offerplant';
$twitter ='http://twitter.com/offerplant';
$linkedin ='http://linkedin.com/company/offerplant';
$youtube ='http://youtube.com';
$pinterest ='http://pinterest.com/offerplant';
$instagram ='http://instagram.com/offerplant';
$yt_live = 'https://www.youtube.com/embed/live_stream?channel=UCZMZpy3Ak_Y9ckeltZqVx7Q';

//https://www.youtube.com/account_advanced // FOR CHANNEL LINK


$app_name ='Apprise 1.0';
$dev_company ="OfferPlant Technologies Private Limited";
$dev_by ="OfferPlant";
$dev_url ="http://offerplant.com";
$dev_email ="ask@offerplant.com";
$dev_contact ="9431426600";


$host_name ='localhost';
$db_user ='brimshos_user';
$db_password ='@User_2001';
$db_name ='brimshos_db';
$base_url = 'https://brimshospitals.com/app/';
$file_url = 'https://brimshospitals.com/app/upload/';

$gender_list =array('','MALE','FEMALE','OTHER');


$order_status_list =array('PENDING','CONFIRMED','CANCELED','DISPATCHED','DELIVERED');
$product_status_list = array('ACTIVE','PENDING');
$app_status_list = array('APPROVED','CANCELED','PENDING');
$status_list = array('ACTIVE','INACTIVE','BLOCK');
$user_type_list = array('VISITOR','MEMBER','ADVISOR');

//$unit_list = array('PC'=>'PC', 'STRIP'=>'STRIP','BOX'=>'BOX','UNIT'=>'UNIT');

$unit_list =array('PC','STRIP','BOX','UNIT');
$product_type_list =array('DOCTOR CONSULTATION','MEDICINE','LAB SERVICES','OTHER SERVICES');

$category_list = array('Fruit','Vegetable','Corona','Dried');

$month_list = array('April','May','June','July','August','September','October','November','December','January','February','March');

$txn_mode_list = array('Cash','Bank Transfer','UPI','Wallet Transfer','Cheque','Other');

$validity_list =array(0,1,2,3,4,6,9,12,24,36);
$invoice_type_list =array('ESTIMATE','INVOICE');

$member_validity ='1 years';

/*-------End of Basic Details ---------*/

?>