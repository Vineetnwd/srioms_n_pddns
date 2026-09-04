<?php
require('function.php');
$_POST =post_clean($_POST);
$_GET =post_clean($_GET);
//if(isset($_GET['task']) && verify_request())
if(isset($_GET['task']))
	{
	$task =xss_clean($_GET['task']);
	switch($task)
		{	
			Case "master_delete" : // Delete Any Data From Table 
				extract($_POST);
				$res = delete_data($table,$id,$pkey);
				echo json_encode($res);
				break;
			
			Case "send_sms" : // Delete Any Data From Table 
			    //print_r($_POST);
				extract($_POST);
				$res = send_sms($mobile,$sms);
				if($res)
				{
				    $res['status'] ='success';
				    $res['msg'] ='SMS SEND SUCCESSFULLY';
				echo json_encode($res);
				}
				break;
			
			case "bulk_import" :
				extract($_POST);
				//print_r($_POST);
				$res = csvimport($table,$pkey);
				echo "<script> window.location='bulk_update.php?msg=".$res['msg']."' </script>";
				break;
			
			case "bulk_export" :
				if($_SESSION['user_type']=='ADMIN')
				{
					$table=$_REQUEST['table'];
					if(isset($_REQUEST['col_name']))
					{
					        csvexport($table, "id, name, stock, rate");
					}
					else{
							csvexport($table);
					}
				
				}
				break;
				
			Case "active_block" : // Active of Block Selected Records 
				extract($_POST);
				$bdata =array('status'=>$status);
				foreach($id as $i)
				{
				$res = update_data($table,$bdata,$i,$pkey);
				}
				echo json_encode($res);
				break;
				
			Case "master_block" : // BLOCK Any Data From Table 
				extract($_POST);
				//print_r($_POST);
				$bdata =array('status'=>'BLOCK');
				$res = update_data($table,$bdata,$id,$pkey);
				echo json_encode($res);
				break;
			
			Case "block_user" : // BLOCK Any Data From Table 
				extract($_POST);
				//print_r($_POST);
				$bdata =array('status'=>$data_status);
				$res2 = update_data('center_details',$bdata,$id,'center_code');
				$res = update_data('user',$bdata,$id,'user_name');
				$res['msg']  ='User and Center '.$data_status.' Successfully';
				$res['url'] = 'show_user';
				echo json_encode($res);
				break;
				
			Case "update_status" : // Update Status Data From Table 
				extract($_POST);
				//print_r($_POST);
				$st = $_POST['data_status'];
				$sid =$_POST['sid'];
				$bdata =array('status'=>$st);
				foreach($sid as $id)
				{
					if($st=='DELETE')
					{
						$res = delete_data('customer_details',$id,'id');
					}
					else{
						$res = update_data('customer_details',$bdata,$id,'id');
					}
					
				}
				echo json_encode($res);
				break;
				
			case "add_data" : // Add Single Value in Database
				extract($_POST);
				$arr[$col]=$value;
				$res = insert_data($table,$arr);
				echo json_encode($res);
				break;
				
				
			case "edit_user" : // Edit user Infomation Value in Database
			    extract($_POST);
			    //print_r($_POST);
			    $_POST['user_pass'] = md5(trim($user_pass));
				$res = update_data('user',$_POST, $user_id ,'user_id');
				$res['url'] ='show_user';
				echo json_encode($res);
				break;
			
			Case "change_password" : // Change Password of Logged in User
				$current_pass = md5($_POST['current_password']);
				$new_password = md5($_POST['new_password']);
				$where =array('user_id'=>$user_id, 'user_pass'=>$current_pass);
				$res = update_multi_data('user',array('user_pass'=>$new_password), $where);
				echo json_encode($res);
				break;
					
			Case "get_data" : // Return Single Value form Database
				extract($_POST);
				$res = get_data($table,$id,$col);
				echo json_encode($res);
				break;
				
			
			
			Case "verify_login" :
				extract($_POST);
				$user_pass =md5($user_pass);
				$res = direct_sql("select * from user where user_name ='$user_name' and user_pass ='$user_pass' and status !='BLOCK'");
				//print_r($res);
				if ($res['status']=='success' and $res['count'] ==1)
				{
					$uid = $res['data'][0]['user_id'];
					$utype = $res['data'][0]['user_type'];
					$udata =array('status'=>'ACTIVE','token'=>$token);
					$result= update_data('user',$udata,$uid,'user_id');
					if($utype =='CLIENT') 
						{ 
							$result['url'] = 'client_index';
						} 
						else{ 
							$result['url']='index';
						}
					$_SESSION['user_id'] = $res['data'][0]['user_id'];
					$_SESSION['user_type'] = $res['data'][0]['user_type'];
					$_SESSION['user_name'] = $res['data'][0]['user_name'];
					//setcookie("username", $_SESSION['user_name'], time()+3600, "/", "",  0);
				}
				else{
					$result['id'] =0;
					$result['status'] ='fail';
					$result['msg'] ='system is already Login';
				}
				echo json_encode($result);
				break;
			Case "logout" :
				$user_id =$_SESSION['user_id'];
				unset($_SESSION['user_name']);
				unset($_SESSION['user_type']);
				unset($_SESSION['user_id']);
				session_destroy();
				$udata =array('token'=>'','status'=>'LOGOUT');
				$result= update_data('user',$udata,$user_id,'user_id');
				echo json_encode($result);
				break;
				
			case "forget_password" :
				$user_name  =$_REQUEST['user_name'];
				$result = get_data('user', $user_name, null, 'user_name');
				//print_r($result);
				
				if($result['count']>0)
				{
				    $res =$result['data'];
					$id = $res['user_id'];
					$user_email = $res['email'];
					$user_mobile = $res['mobile'];
					$np =rnd_str(6);
					$up = array('user_pass'=>md5($np));
					update_data('user',$up,$id,'user_id');
					$dlt_id ='';
					$sms = $user_name." Your new password is ".$np ." kindly change after login "; 
					
    			    $info ="<hr><table rules='1' align='center' width='70%' cellpadding='5'>";
    			    
    			    foreach ($res as $key => $value) 
    			    {
    			        $info = $info."<tr><td>".addspace($key)."</td><td>".$value ."</td></tr>";
    			    }
    			    $info =$info."</table>";
    			    
    			    rtfmail($user_email, "Password Changed of " .$user_name, $sms.$info);
			    
					send_sms($user_mobile,$sms);
					$data['id'] =$id;
					$data['status'] ='success';
					$data['msg'] ="Your New Password Successfully Send to $user_email";
				}
				else{
					$data['id'] =0;
					$data['status'] ='error';
					$data['msg'] ='No any user exist with this ID. Try Again';
				}
				echo json_encode($data);
				break;
		/*============center Module ============*/
			
			
			Case "get_dist" :
				$code = $_GET['state_code'];
				$res =get_all('district','*',array('state_code'=>$code))['data'];
				foreach($res as $dist)
				{
					echo "<option value='".$dist['dist_code']."'>". $dist['dist_name'] ."</option>";
				}
				break;
			
			
			Case "upload" :
				//print_r($_FILES);
				//$file_name , $imgkey = 'rand', $target_dir = "upload"
				$result =uploadimg('uploadimg', 'rand','upload');
				echo json_encode($result);
				break;
						
			/* ========= Wallet & Scheme =======*/
			case "add_to_wallet_old" :
				extract($_POST);
				$cbal = get_data('member',$member_id,'current_wallet')['data'];
				$nbal =$cbal+ $credit_amt;
				$_POST['balance'] = $nbal;
				$res = insert_data('wallet', $_POST);
				update_data('member', array('current_wallet'=>$nbal), $member_id);
				$res['url'] ='transaction';
				echo json_encode($res);
				break;
			
			case "add_to_wallet" :
				extract($_POST);
				$credit_amt = number_format((float)$credit_amt, 2, '.', '');
				if($credit_amt<=0)
				{
				    $res['status'] ='error';
				    $res['data'] =null;
				    $res['msg'] = 'Invalid Plan Selected ';
				}
				else {
    				$nbal = walletplus($member_id,$credit_amt,'Self Recharge by Member',$txn_remarks);
    				if($nbal <>0)
    				{
    				    $res['status'] ='success';
    				    $res['data'] =$nbal;
    				    $res['msg'] = 'Recharge success of amount ' .$credit_amt;
    				}
    				else
    				{
    				    $res['status'] ='error';
    				    $res['data'] =null;
    				    $res['msg'] = 'Recharge Fail ';
    				}
				}
				$res['url'] ='transaction';
				$name = get_data('member',$member_id,'name')['data'];
				$mobile =get_data('member',$member_id,'mobile')['data'];
				$sms = $name .", Recharge of $credit_amt is successfull Your Current balance is $nbal ";
				
				send_sms($mobile,$sms);
				echo json_encode($res);
				break;
				
			case "add_product" :
			    extract($_POST);
				$res = update_data('product', $_POST, $_POST['id']);
				$_SESSION['unit'] = $unit;
				$res['url'] ="manage_product";
				echo json_encode($res);
				break;
				
				
			case "add_member" :
			    extract($_POST);
				$_POST['membership_id'] = date('ymd').$_POST['id'];
				if(!$_POST['joining_date']){ $joining_date=$today;}
				if($_POST['ref_by']!=''){
					
				}
                $_POST['expiry_date'] = date('Y-m-d', strtotime($member_validity ,strtotime($joining_date)));
				$res = update_data('member', $_POST, $_POST['id']);
				$sms = $name ." thanks for choosing ". $inst_name; 
			    $info ="<hr><table rules='1' align='center' width='70%' cellpadding='5'>";
			    foreach ($_POST as $key => $value) 
			    {
			        $info = $info."<tr><td>".addspace($key)."</td><td>".$value ."</td></tr>";
			    }
			    $info =$info."</table>";
			    
			    rtfmail($inst_email, "New Member Joining ! ". $name, $sms.$info);
			    rtfmail($email_id, "Hi ! ". $name. " Greetings from " .$inst_name, $sms.$info);
			    send_sms($mobile , $sms);
				echo json_encode($res);
				break;
			
			case "add_services" :
			    extract($_POST);
				$res = update_data('services', $_POST, $_POST['id']);
				echo json_encode($res);
				break;
				
			case "add_recharge" :
			    extract($_POST);
				$res = update_data('recharge', $_POST, $_POST['id']);
				echo json_encode($res);
				break;
				
			
			case "txn_entry" :
				extract($_POST);
			    
			    $member_id =sprintf("%06d",$_POST['member_id']);
				$member =  get_data('member',$member_id)['data'];
				$_SESSION['inv_no'] =$_POST['invoice_no'];
				$_SESSION['txn_date'] =$_POST['txn_date'];
				unset($_POST['txn_date']);
				$service = get_data('services',$service_id)['data'];
				if($member['user_type'] !='VISITOR')
				{
				    $amount = $service['fee'] -($service['fee']*$service['card_discount']/100);
				}
				else{
				    $amount = $service['fee'];
				}
				$txn_data = array('txn_remarks'=>$service['name'], 'rate'=>$service['fee'], 'amount' =>$amount,'inv_id'=>$inv_id );
			    
			    $res = insert_data('txn', $txn_data);
				$id = $res['id'];
				$sms = "New Transaction in amount ". $amount ; 
			    $info ="<hr><table rules='1' align='center' width='70%' cellpadding='5'>";
			    foreach ($_POST as $key => $value) 
			    {
			        $info = $info."<tr><td>".addspace($key)."</td><td>".$value ."</td></tr>";
			    }
			    $info =$info."</table>";
			    
			    rtfmail($inst_email, $sms, $sms. $info);
				$link=encode('member_id='.$member_id.'&action=txn');
				$res['url'] ='txn_entry?link='.$link;
				
				echo json_encode($res);
				break;
			
			
			Case "medicine_entry" :
				extract($_POST);
			
				if($qty ==0 || $qty =='')
				{
					$res['id'] =0;
					$res['status'] ='error';
					$res['msg'] ='Quantity can not be Zero';
				} 
				else{
    				$member_id =sprintf("%06d",$_POST['member_id']);
    				if($member_id !='' and $product_id !='' and $amount!='')
    				{
    				$member =  get_data('member',$member_id)['data'];
    				$_SESSION['invoice_no'] =$_POST['invoice_no'];
    				$_SESSION['invoice_date'] =$_POST['invoice_date'];
    				$_SESSION['invoice_type'] =$_POST['invoice_type'];
    				unset($_POST['invoice_date']);
    				unset($_POST['invoice_type']);
    				$_POST['txn_remarks']= get_data('product', $product_id,'name')['data'];
    				$res = insert_data('txn', $_POST);
    				$id = $res['id'];
    				$link=encode('member_id='.$member_id.'&action=txn');
    				$res['url'] ='medicine?link='.$link;
    				
    				}
    				else{
    					$res['id'] =0;
    					$res['status'] ='error';
    					$res['msg'] ='Zero Transaction amount not allowed';
    				}
				}
				echo json_encode($res);
				break;
				
		    Case "close_invoice_old" :
				extract($_POST);
				//print_r($_POST);
				$_POST['status']='CLOSE';
				$payment =$_POST['total_paid'] = $cash +$bank +$wallet;
				if($net_payable ==0 && $payment ==0)
				{
					$res['id'] =0;
					$res['status'] ='error';
					$res['msg'] ='Total amount and Invoice Amount can not be Zero';
				} 
				else{
				    unset($_SESSION['invoice_no']);
					$member =get_data('member',$member_id)['data'];
					$current_wallet = $_POST['current_wallet'] =$member['current_wallet'];
				   if($wallet <> 0)
				   {
				    $nbal =$current_wallet- $wallet;
				    $wdata =array('txn_mode' =>'Wallet Balance Used', 'debit_amt'=>$wallet,'member_id'=>$member_id,'txn_remarks'=> 'Invoice No ' .$id .' of Amount ' . $net_payable, 'txn_date'=>$today,'status'=>'SUCCESS','balance'=>$nbal);
			    	$res1 =insert_data('wallet', $wdata);
					$res3 = update_data('member',array('current_wallet'=>$nbal),$member_id);
					}
					
			    	$res2 = update_data('invoice',$_POST,$id);
				   	$sms ="Dear Sir/Madam, Your last Transaction Details is updated and wallet balance is  ".$nbal;
				
					$link = encode('invoice_id='.$id);
					$res2['url'] ="print_invoice.php?link=$link";
					send_sms($member['mobile'], $sms);
				}
				echo json_encode($res2);
				
				break;


			Case "close_invoice" :
				extract($_POST);
			    $_POST['status']='CLOSE';
				$payment =$_POST['total_paid'] = $cash +$bank +$wallet;
				if($net_payable ==0 && $payment ==0)
				{
					$res['id'] =0;
					$res['status'] ='error';
					$res['msg'] ='Total amount and Invoice Amount can not be Zero';
				} 
				else{
				    unset($_SESSION['invoice_no']);
				    unset($_SESSION['invoice_type']);
					$member =get_data('member',$member_id)['data'];
					
					if($cash <> 0)
				    {
						walletplus($member_id, $cash ,'Cash Recived');
					}
					if($bank <> 0)
				    {
						walletplus($member_id, $bank ,'Digital Payment Recived ');
					}
					
					if($net_payable <> 0)
				    {
						$nbal = walletminus($member_id, $net_payable ,'Paid from Wallet','Payment Against Invoice '. $id);
			 		$ref_by = get_data('member',$member_id,'ref_by')['data'];
    			 		if( $ref_by !=0)
    			 		{
    						    $_POST['com_to'] =$ref_by;
    						    $_POST['com_amt'] =($cash+$bank)/10;
    			 		}
					}
					
					$res2 = update_data('invoice',$_POST,$id);
				   	$sms ="Dear Sir/Madam, Your last Transaction Details is updated and wallet balance is  ".$nbal;
				    invoice_no($id);
					$link = encode('invoice_id='.$id);
					$res2['url'] ="print_invoice.php?link=$link";
				}
				
				$sms = "New Transaction in amount ". $amount ; 
			    $info ="<hr><table rules='1' align='center' width='70%' cellpadding='5'>";
			    foreach ($_POST as $key => $value) 
			    {
			        $info = $info."<tr><td>".addspace($key)."</td><td>".$value ."</td></tr>";
			    }
			    $info =$info."</table>";
			    
			    rtfmail($inst_email, $sms, $sms. $info);
			    
				$name = get_data('member',$member_id,'name')['data'];
				$mobile =get_data('member',$member_id,'mobile')['data'];
				$sms ="$name , Rs. $payment is Recived against Invoice No. $id Your Wallet balance is $nbal ";
				
				send_sms($mobile,$sms);
				
			    echo json_encode($res2);
				
				break;					
				
			case "buy_product":
				extract($_POST);
				$order  = get_all('order_details','*',array('product_id'=>$product_id,'customer_id'=>$customer_id));
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
				$res['count']  = get_all('order_details','*',array('customer_id'=>$customer_id))['count'];
				echo json_encode($res);
				break;

			case "checkout":
				extract($_POST);
				unset($_POST['tc']);
				unset($_POST['cod']);
				$_POST['status'] ='PENDING';
				$res = update_data('customer_details',$_POST,$id);
				$res['otp'] =rand(1000,9999);
				echo json_encode($res);
				break;
				
			case "finish":
				extract($_POST);
				$_POST['order_id'] = $order_id  ='VB'.(1000+$id);
				$_POST['amount'] = $amount;
				$_POST['status'] ='COMPLETE';
				$res = update_data('customer_details',$_POST,$id);
				$mobile = get_data('customer_details',$id,'mobile','id')['data'];
				$link =encode('c='.$id);
				$res['msg'] = $sms ="Your Order Completed Successfully with order No ". $order_id. " of amount ". $amount ." Thanks ".$inst_url.'/pi.php?c='.$link;
				sendsms($mobile,$sms);
				echo json_encode($res);
				break;
			
		    case "uploadlist" :
				//$baseFromJavascript = $_POST['student_photo']; //your data in base64 'data:image/png....';
                //$base_to_php = explode(',', $baseFromJavascript);
               echo  $data = base64_decode($_POST['upload_list']);
                /*$file_name = date('ymdhis')."_".rnd_str(5).".png";	
                $filepath = "upload/image.png "; //.$file_name; // or image.jpg
                file_put_contents($filepath,$data);
                rename($filepath, 'upload/'.$file_name);
                $res['msg'] = "The file ". $file_name. " has been uploaded.";
                $res['id'] = $file_name;
				$res['status'] ='success';
				echo json_encode($res); */
				break;
				
			case "upload_photo" :
    			    
    			    extract($_POST);
    			    //print_r($_POST);
    				$baseFromJavascript = $_POST['photo']; //your data in base64 'data:image/png....';
                    $base_to_php = explode(',', $baseFromJavascript);
                    $data = base64_decode($base_to_php[1]);
                    $file_name = date('ymdhis')."_".rand(100,999).".png";
                    file_put_contents("upload/".$file_name,$data);
                    //$data = base64_decode($_POST['student_photo']);
                    /*$file_name = date('ymdhis')."_".rnd_str(5).".png";	
                    $filepath = "upload/image.png "; //.$file_name; // or image.jpg
                    file_put_contents($filepath,$data);
                    rename($filepath, 'upload/'.$file_name);
                    $res['msg'] = "The Photo ". $file_name. " has been uploaded.";
                    //update_data('student',array('photo'=>$file_name),$ref_no,'ref_no');*/
                    $res['id'] = $file_name;
                    $res['status'] ='success';
    				echo json_encode($res);
    				break;
			
			
			default :
				echo "<script> alert('Invalid Action'); window.location ='index.php'; </script>";	
				
		}

}
?>