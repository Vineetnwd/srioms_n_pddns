<?php
header("Access-Control-Allow-Origin: *");
require('function.php');
$_POST =post_clean($_POST);
$_GET =post_clean($_GET);
if(isset($_GET['task']))
	{
	$task =xss_clean($_GET['task']);
	switch($task)
		{	
			case "app_info" : // Latest Update 
			    $res =array('name'=>$app_name,'version'=>$app_version);
				echo json_encode($res);
				break;
			
			case "get_member" :
			    //print_r($_REQUEST);
			    $mobile =$_REQUEST['mobile'];
			    $otp =rand(100000,999999);
			    //$fres =get_data('member',$mobile, null, 'mobile');
			    $fres =get_all('member','*', array('mobile'=>$mobile));
			    if($fres['count']==0)
			    {
			        $joining_date = date('Y-m-d');
			        $expiry_date = date('Y-m-d', strtotime('1 months' ,strtotime($joining_date)));
			       $res = insert_data('member',array('mobile'=>$mobile,'created_at'=>date('Y-m-d h:i:s'),'otp'=>$otp,'joining_date'=>$joining_date,'expiry_date'=>$expiry_date,'account_type'=>'PRIMARY'));
			       $membership_id = date('ymd').$filled_int = sprintf("%06d", $res['id']);
			       $res = update_data('member',array('membership_id'=>$membership_id),$mobile,'mobile');
			    }
			    $res9 =get_all('member',array('id','name','user_type','membership_id'), array('mobile'=>$mobile));
			    
			    $res9['otp'] =$otp;
			    $name =$res9['data'][0]['name'];
			    $sms ="Hi $name , Enter OTP  $otp to Login. Regards $inst_name ";
				send_sms($mobile,$sms);
				echo json_encode($res9);
				break;	
			
			case "new_member" :
			    extract($_REQUEST);
			    $_POST['status']='ACTIVE';
			    $_POST['joining_date'] = date('Y-m-d');
			    $_POST['expiry_date'] = date('Y-m-d', strtotime('1 months' ,strtotime($joining_date)));
			    $res = insert_data('member',$_POST);
			    $membership_id = date('ymd').$filled_int = sprintf("%06d", $res['id']);
			    update_data('member',array('membership_id'=>$membership_id),$res['id']);
    			if($ref_by!='')
    			   {
    			    walletminus($ref_by,100,'Membership Fee' ,$name);
    			    walletplus($res['id'],100,'Balance Added' ,'By Agent');
    			    $advisor_name = get_data('member',$ref_by,'name')['data'];
    			   }
    			$mobile =get_data('member',$res['id'],'mobile')['data'];
    			//$sms ="Hi $name , Thanks for Joining BRIMS Family. Your BRIMS ID is $membership_id . Click to Download Our App bit.ly/brimsapp ";
    			$sms = "Congrats Mr. / Mrs. " .$name." Your BRIMS ID is ". $membership_id ." Please Pay Rs. 99 to Mr. " .$advisor_name." Download Brims App http://bit.ly/brimsapp to activate your card";  
				send_sms($mobile,$sms);
			    echo json_encode($res);
				break;	
				
			case "update_member" :
			    extract($_REQUEST);
			    $_POST['status']='ACTIVE';
			    $res = update_data('member',$_POST,$id);
			    echo json_encode($res);
				break;	
			
			case "get_profile" :
			    extract($_REQUEST);
			    $res = get_data('member',$id);
			    echo json_encode($res['data']);
				break;	
				
			case "get_wallet" : // Add Single Value in Database
			    extract($_POST);
				$res = get_all('member',$id,'current_wallet');
				echo json_encode($res);
				break;
				
			case "update_payment" :
				extract($_POST);
				
				$nbal = walletplus($member_id,$amount,'Self Recharge by Member',$txn_remarks);
				if($nbal <>0)
				{
				    $res['status'] ='success';
				    $res['data'] =$nbal;
				    $res['msg'] = 'recharge success of amount' .$amount;
				}
				else
				{
				    $res['status'] ='error';
				    $res['data'] =null;
				    $res['msg'] = 'Recharge Fail ';
				}
				echo json_encode($res);
				$name = get_data('member',$member_id,'name')['data'];
				$mobile =get_data('member',$member_id,'mobile')['data'];
				$sms ="Hi $name , Recharge of $amount is successfull Your Current balance is $nbal. Regards $inst_name $app_link ";
				
				send_sms($mobile,$sms);
			
				break;
				
		     case "book_appointment":
		         extract($_REQUEST);
		         $res = insert_data('appointment',$_POST);
    	         	if($res['id']!=0)
    		    	{
    		    	   $res['msg'] ="Appointment Booked Successfully with App No. ". $res['id'];
    		    	}
    		    $name = get_data('member',$member_id,'name')['data'];
    		    $mobile =get_data('member',$member_id,'mobile')['data'];
				$sms ="Hi ". $name .", ". $res['msg'] ." Regards ". $inst_name ."  ". $app_link;
				send_sms($mobile,$sms);
		         echo json_encode($res);
		         break;
		        
		    
		    case "view_cart" : // Show Product in cart
			    extract($_POST);
				$res = direct_sql("select  order_details.id,product_details.name, product_details.photo,product_details.unit, order_details.qty, order_details.rate,order_details.amount from product_details, order_details where order_details.invoice_id ='$invoice_id' and order_details.product_id =product_details.id");
				echo json_encode($res);
				break;	
				
			case "get_services" : // Get Category Wise Product List
			     extract($_REQUEST);
			    	$res = direct_sql("select name as Service, concat(card_discount,'%') as Mem_Disc, concat('<div class=btn_service data-id=',id,'>',mrp,'</div>') as Fee from product where status ='ACTIVE'");
			   	echo json_encode($res);
				break;
			
			case "get_services_web" : // Get Category Wise Product List
			     extract($_REQUEST);
			    	$res = direct_sql("select name as Service, details as Description, concat(card_discount,'%') as Member_Discount, concat('<div class=btn_service data-id=',id,'>',mrp,'</div>') as Fee from product where status ='ACTIVE'");
			   	echo json_encode($res);
				break;
	
			case "product_by_type" : // Get Category Wise Product List
			     extract($_REQUEST);
			     $product_type = $_POST['product_type'];
			     $res = direct_sql("select id, name, concat('Rs.',mrp) as mrp from product where status ='ACTIVE' and type like '%$product_type%' ");
			   	echo json_encode($res,true);
				break;
			
			case "get_recharge" : // Get Category Wise Product List
			   extract($_REQUEST);
			    	$res = direct_sql("select name as Name,  wallet as Benifit, concat(validity, ' M') as Validity, concat('<div class=member_plan data-amount=',amount,'>', amount,'</div>') as Amount from recharge where status ='ACTIVE'");
			    
			   	echo json_encode($res);
				break;
				
			case "get_appointment" : // Get Category Wise Product List
			   extract($_REQUEST);
			     $sql ="select DATE_FORMAT(app_date, '%d%b%y') as Date, product_type as Task ,remarks as Message , status as Status from appointment where member_id ='$member_id' and status<>'AUTO' order by id desc";
			    $res =direct_sql($sql);
			   	echo json_encode($res);
			   	
				break;
				
			case "get_order" : // Get Orders of a Member
			    extract($_REQUEST);
			    $member_id = $_REQUEST['req_by'];
			    $sql ="select id as OrderNo, DATE_FORMAT(created_at, '%d/%b/%y') as Date, concat('<a href=$file_url',upload_list,'>Link</a>') as Images, status as Status from medicine_order where member_id ='$member_id' and status<>'AUTO' order by id desc";
			    $res =direct_sql($sql);
			   	echo json_encode($res);
				break;
			
			case "get_txn" : // Get Orders of a Member
			    extract($_REQUEST);
			    $member_id = $_REQUEST['member_id'];
			    $sql ="select DATE_FORMAT(created_at, '%d/%b/%y') as Date, txn_mode as Details, debit_amt as Debit, credit_amt as Credit from wallet where member_id ='$member_id' and status<>'AUTO' order by id desc";
			    $res =direct_sql($sql);
			   	echo json_encode($res);
				break;	
			
			case "get_ref" : // Get Orders of a Member
			    extract($_REQUEST);
			    $member_id = $_REQUEST['req_by'];
			    $sql ="select name as Name, mobile as Mobile, concat('<div class=btn_wallet data-id=',id,'>', current_wallet,'</div>') as Balance from member where ref_by ='$member_id' and status<>'AUTO' order by id desc";
			    $res =direct_sql($sql);
			   	echo json_encode($res);
				break;		
			
			case "get_income" : // Get Orders of a Member
			    extract($_REQUEST);
			    $member_id = $_REQUEST['req_by'];
			    $sql ="SELECT member.name, DATE_FORMAT(invoice_date, '%d/%m') as Date, net_payable as Bill, cash+bank as Counter, com_amt as Comm FROM `invoice`, member where invoice.member_id = member.id and com_to =$member_id order by invoice.id desc";
			    $res =direct_sql($sql);
			   	echo json_encode($res);
				break;		
				
			case "show_invoice" : // Get Category Wise Product List
			    $invoice_id = $_REQUEST['invoice_id'];
			    
			    $res =get_data('invoice_details',$invoice_id);
			    $res['item'] = get_all('order_details','*',array('invoice_id'=>$invoice_id));
			    
			   	echo json_encode($res);
				break;
			
			case "cancel_invoice" : // Get Category Wise Product List
			    $invoice_id = $_REQUEST['invoice_id'];
			    
			    $res =update_data('invoice_details', array('status'=>'CANCELED'),$invoice_id);
			    echo json_encode($res);
				break;
				
			case "buy_product": // Add to Cart Button
			    //print_r($_POST);
			    extract($_POST);
				$invoice_id =$_REQUEST['invoice_id'];
				$product_id =$_REQUEST['product_id'];
				$qty =$_REQUEST['qty'];
				$rate =$_REQUEST['rate'];
				if($product_id!='undefined')
				{
				if($invoice_id==0)
				{
				    $newinvoice = insert_data('invoice_details',array('customer_id'=>$customer_id,'status'=>'PENDING','created_by'=>$customer_id,'created_at'=>date('Y-m-d h:i:s')));
				    $_POST['invoice_id'] = $invoice_id =$newinvoice['id'];
				}
			
				$order = get_multi_data('order_details',array('invoice_id'=>$invoice_id,'product_id'=>$product_id));
				
				if($order['count']>0)
				{
					$order_id = $order['data'][0]['id'];
					$old_qty = $order['data'][0]['qty'];
					$_POST['qty'] = $new_qty = $old_qty +$qty;
					$_POST['amount'] = $new_qty*$rate;
					$res = update_data('order_details', $_POST, $order_id);
				}
				else{
					$res = insert_data('order_details', $_POST);
				}
				$res['count']  = get_all('order_details','*',array('invoice_id'=>$invoice_id))['count'];
				$res['msg']='Added to Cart';
				$res['invoice_id'] =$invoice_id;
				
				}
				else{
				    $res['status']='error';
				    $res['msg']='Invalid Product';
				}
				echo json_encode($res);
				break;
				
			case "view_cart" : // Show Product in cart
			    extract($_POST);
				$res = direct_sql("select  order_details.id,product_details.name, product_details.photo,product_details.unit, order_details.qty, order_details.rate,order_details.amount from product_details, order_details where order_details.invoice_id ='$invoice_id' and order_details.product_id =product_details.id");
				echo json_encode($res);
				break;	
				
		    case "remove_product": // Remove Product From cart
				print_r($_POST);
				$res = delete_data('order_details',$_POST['order_id'],'id');
				echo json_encode($res);
				break;	
				
			case "checkout":
			    //print_r($_POST);
				extract($_POST);
				$mobile =get_data('customer_details',$customer_id,'mobile')['data'];
				$name =get_data('customer_details',$customer_id,'name')['data'];
				$link = encode('invoice_id='.$invoice_id);
				$idata =array('status'=>'CONFIRMED','amount'=>$amount,'invoice_date'=>date('Y-m-d'), 'created_at'=>date('Y-m-d h:i:s'), 'customer_id'=>$customer_id);
				$res =api_update_data('invoice_details',$idata,$invoice_id);
				
				$res['msg'] = $sms ="Dear ". $name .", Your Order Placed Successfully with Invoice No. ". $invoice_id. " of amount Rs. ". $amount ." Thanks ". $inst_url.'/market/pi?p='.$link;
				//$sms2 =" A new Order ". $invoice_id." is placed by " .$name." [ ". $mobile. " ] of amount ". $amount;
				//send_sms($inst_contact,$sms2);
				echo json_encode($res);
				break;
				
		/*============Transaction Module ============*/	
		    case "uploadlist" :
				//$baseFromJavascript = $_POST['student_photo']; //your data in base64 'data:image/png....';
                //$base_to_php = explode(',', $baseFromJavascript);
                $data = base64_decode($_POST['upload_list']);
                $_POST['upload_list'] =$file_name = date('ymdhis')."_".rnd_str(5).".png";	
                //$filepath = "upload/image.png "; //.$file_name; // or image.jpg
                file_put_contents('upload/'.$file_name,$data);
                //rename($filepath, 'upload/'.$file_name);
                $res['msg'] = "The file ". $file_name. " has been uploaded.";
                $res['file_name'] = $file_name;
                $ord = insert_data('medicine_order',$_POST);
                $res['id'] = $ord['id'];
				$res['status'] ='success';
				echo json_encode($res);
				break;
				
			 case "member_photo" :
			    extract($_POST);
			    $data = base64_decode($_POST['photo']);
                $file_name = 'm_'.date('ymdhis')."_".rnd_str(5).".png";	
                file_put_contents('upload/'.$file_name,$data);
                $res = update_data('member',array('photo'=>$file_name), $id);
                if($res['status']=='success')
                 {
                $res['msg'] = "The file ". $file_name. " has been uploaded.";
                $res['file_name'] = $file_name;
                 }
				echo json_encode($res);
				break;
				
			case "member_docs" :
			    extract($_POST);
			    $data = base64_decode($_POST['docs']);
                $file_name = 'd_'.date('ymdhis')."_".rnd_str(5).".png";	
                file_put_contents('upload/'.$file_name,$data);
                $res = update_data('member',array('docs'=>$file_name), $id);
                if($res['status']=='success')
                 {
                $res['msg'] = "The file ". $file_name. " has been uploaded.";
                $res['file_name'] = $file_name;
                 }
				echo json_encode($res);
				break;
		    
		    case "confirm_order" :
		        extract($_POST);
		        $res = update_data('medicine_order',$_POST, $id);
		        $res['msg'] = "Order Place Successfully with order No. $id";
		       	echo json_encode($res);
				break;
				
			case "final_submit" :
		        extract($_POST);
		        $joining_date = date('Y-m-d');
			    $expiry_date = date('Y-m-d', strtotime('12 months' ,strtotime($joining_date)));
		        $data = array('status'=>'ACTIVE','user_type'=>'MEMBER','expiry_date'=>$expiry_date);
		        $res = update_data('member',$data, $id);
		        walletminus($id,99,'Membership Fee' ,'Deducted From Wallet');
		        walletplus($id,99,'Joining CashBack' ,'1st Joining');
		        $name =get_data('member',$id,'name')['data'];
		        $card_no =get_data('member',$id,'membership_id')['data'];
		        $res['msg'] = "Hello $name BRIMS Card $card_no Applied Successfully";
		       	echo json_encode($res);
		       	$mobile =get_data('member',$id,'mobile')['data'];
		       	send_sms($mobile,$res['msg']);
		       	
				break;
				
			default :
				echo "<script> alert('Invalid Action'); window.location ='index.php'; </script>";	
				
		}

}
?>