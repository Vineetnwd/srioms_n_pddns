<?php
require_once('config.php');
$con = mysqli_connect( $host_name, $db_user, $db_password, $db_name) or die("Unable to Connect, Check the Connection Parameter. " .mysqli_error($con)) ;

/*---------OfferPlant Master Functions-------------*/
if(isset($_SESSION['visitor_id']))
{
    $user_id = $_SESSION['visitor_id'];
}

function encode($input) {
 return strtr(base64_encode($input), '+/=', '._-');
}

function decode($input) {
 $url = base64_decode(strtr($input, '._-', '+/=')); 
 //$parts = parse_url($url);
 parse_str($url, $query);
 return $query;
}

function rnd_str($length_of_string) 
{ 
    // String of all alphanumeric character 
    //$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
  
    // Shufle the $str_result and returns substring 
    // of specified length 
    return strtoupper(substr(str_shuffle($str_result),0, $length_of_string)); 
} 
function xss_clean($data)
{
        // Fix &entity\n;
        $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do
        {
                // Remove really unwanted tags
                $old_data = $data;
                $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        }
        while ($old_data !== $data);

        // we are done...
        return $data;
}

function post_clean($arr_data)
{
	if(is_array($arr_data))
	{
		foreach( $arr_data as $data)
		{
			
		$key = array_search ($data, $arr_data);
			if(is_array($data))
			{
				post_clean($data);
			}
			else{
			$arr_data[$key] =xss_clean($data);
			}
		}
	}
	else{
		xss_clean($arr_data);
	}
	return $arr_data;
}

function verify_request()
    {
        $ref = parse_url($_SERVER["HTTP_REFERER"]);
        $rh  = $ref['host'];
        $mh = $_SERVER['HTTP_HOST'];
        
        if($rh <> $mh)
        {
            return false;
        }
		else{
			return true;
		}
    }
	
function verify($user_type)
{
	$actual_link = "http://".$_SERVER['HTTP_HOST']; //$_SERVER['REQUEST_URI'];
	//die($actual_link);
	$current_page = basename($_SERVER['REQUEST_URI'], '?'. $_SERVER['QUERY_STRING']);
	if($user_type =='ADMIN') { 
	    global $admin_role;
	    $all_page = $admin_role;
	}
	else if($user_type =='CLIENT') { 
	    global $client_role;
	    $all_page = $client_role;
	}
	
	else{
	    die("Invalid User ! Don't Have Permission");
	}
	
	if (!array_search($current_page,$all_page))
	{
			die("Don't have Permission");
	}			
}

function add_column($table_name, $col_name, $data_type ='varchar(255)', $default =null )
	{
		global $con;
		$sql ="alter table $table_name add column $col_name $data_type $default"; 
		$res =mysqli_query($con,$sql) or die("Error in Adding Column". mysqli_error($con));
	}
function remove_column($table_name, $col_name )
	{
		global $con;
		$sql ="alter table $table_name drop column $col_name "; 
		$res =mysqli_query($con,$sql) or die("Error in Removing Column". mysqli_error($con));
	}
function insert_row($table_name )
	{
		global $con;
		global $user_id;
		$result = get_multi_data($table_name, array('created_by'=>$user_id,'status'=>'AUTO'), ' order by id desc limit 1');
		if($result['count'] <1) 
		{
		$result = insert_data( $table_name, array('status'=>'AUTO'));
		$id = $result['id'];
		}
		else{
			$id = $result['data'][0]['id'];
		}		
		return array('table'=>$table_name,'id'=>$id);
	}
	
function insert_data( $table_name, $ArrayData)
	{
		global $con;
		global $user_id;
		//echo"<pre>";
		//print_r($ArrayData);
		$ArrayData['created_by'] =$user_id;
		$columns = implode(", ",array_keys($ArrayData));
		$escaped_values =array_values($ArrayData);
		foreach ($escaped_values as $newvalue)
		{
			$newvalues[] = "'".post_clean($newvalue)."'";	
		}
		//$data = mysqli_escape_string ($escaped_values);
		$values  = implode(", ", $newvalues);

		$sql = "INSERT IGNORE INTO $table_name ($columns) VALUES ($values)";
		
		$res =mysqli_query($con,$sql) or die("Error in Inserting Data". mysqli_error($con));
		$id = mysqli_insert_id($con);
		if(mysqli_affected_rows($con)>0)
		{
			$result['id'] =$id;	
			$result['status'] ='success';	
			$result['msg'] =" Data Inserted Successfully";
		}
		else{
			$result['id'] =0;	
			$result['status'] ='error';	
			$result['msg'] = mysqli_error($con);
		}
		return $result;	
	}
function insert_html( $table_name, $ArrayData)
	{
		global $con;
		global $user_id;
		//echo"<pre>";
		//print_r($ArrayData);
		$ArrayData['created_by'] =$user_id;
		$columns = implode(", ",array_keys($ArrayData));
		$escaped_values =array_values($ArrayData);
		foreach ($escaped_values as $newvalue)
		{
			$newvalues[] = "'". htmlspecialchars($newvalue)."'";
			
		}
		//$data = mysqli_escape_string ($escaped_values);
		$values  = implode(", ", $newvalues);

		$sql = "INSERT IGNORE INTO $table_name ($columns) VALUES ($values)";
		
		$res =mysqli_query($con,$sql) or die("Error in Inserting Data". mysqli_error($con));
		$id = mysqli_insert_id($con);
		if(mysqli_affected_rows($con)>0)
		{
			$result['id'] =$id;	
			$result['status'] ='success';	
			$result['msg'] =" Data Inserted Successfully";
		}
		return $result;	
	}	
function update_data( $table_name, $ArrayData, $id, $pkey='id' )
	{
		global $con;
		global $user_id;
		if(isset($user_id) and $user_id !='')
		{
		    $ArrayData['created_by'] =$user_id;
		}
		else{
		 	$ArrayData['created_by'] =0;  
		}
		$cols = array();
 		foreach($ArrayData as $key=>$value) 
			{
				$newvalue = post_clean($value);
				$cols[] = "$key = '$newvalue'";
			}
		$sql = "UPDATE $table_name SET " . implode(', ', $cols) . " WHERE $pkey  ='".$id ."'";
		$res=mysqli_query($con,$sql) or mysqli_error($con);
		$num = mysqli_affected_rows($con);
		if($num>0)
		{
			$result['id'] =$id;	
			$result['status'] ='success';	
			$result['msg'] = $num." Record Updated Successfully";
		}
		else{
			$result['id'] =$id;	
			$result['status'] ='error';	
			$result['msg'] = "Sorry ! No Update Found" .mysqli_error($con);
		}
		return $result;	
	}
	
	function api_update_data( $table_name, $ArrayData, $id, $pkey='id' )
	{
		global $con;
		global $user_id;
		$ArrayData['created_by'] =$id;
		$cols = array();
 		foreach($ArrayData as $key=>$value) 
			{
				$newvalue = post_clean($value);
				$cols[] = "$key = '$newvalue'";
			}
		$sql = "UPDATE $table_name SET " . implode(', ', $cols) . " WHERE $pkey  ='".$id ."'";
		$res=mysqli_query($con,$sql) or mysqli_error($con);
		$num = mysqli_affected_rows($con);
		if($num>0)
		{
			$result['id'] =$id;	
			$result['status'] ='success';	
			$result['msg'] = $num." Record Updated Successfully";
		}
		else{
			$result['id'] =$id;	
			$result['status'] ='error';	
			$result['msg'] = "Sorry ! No Update Found" .mysqli_error($con);
		}
		return $result;	
	}
	
function update_multi_data( $table_name, $ArrayData, $whereArr )
	{
		global $con;
		$cols = array();
 		foreach($ArrayData as $key=>$value) 
			{
				$newvalue = post_clean($value);
				$cols[] = "$key = '$newvalue'";
			}
		
		foreach($whereArr as $key=>$value) 
			{
				$newvalue = post_clean($value);
				$where[] = "$key = '$newvalue'";
			}
			
		$sql = "UPDATE $table_name SET " . implode(', ', $cols) . " WHERE " .implode('and ', $where);
		$res=mysqli_query($con,$sql) or mysqli_error($con);
		$num = mysqli_affected_rows($con);
		if($num>0)
		{
			$result['status'] ='success';	
			$result['msg'] = $num." Multi Record Updated Successfully";
		}
		else{
			$result['status'] ='Fail';	
			$result['msg'] = " No Update found";
		}
		return $result;	
	}
	
function delete_data( $table_name, $id ,$pkey='id')
	{
		global $con;
		$sql = "delete from $table_name WHERE $pkey  ='".$id ."'";
		$res =mysqli_query($con,$sql) or die("Error in Deleting Data". mysqli_error($con));
		$num = mysqli_affected_rows($con);
		if($num >=1)
		{
		 $result['id']=$id;
		 $result['status']='success';
		 $result['msg'] =$num. " Record deleted successfully";
		}else{
			$result['id']=$id;
			$result['status']='error';
			$result['msg'] = "Sorry ! No record found to delete";
		}
		return $result;
	}
	
function delete_multi_data( $table_name, $whereArr)
	{
		global $con;
		foreach($whereArr as $key=>$value) 
			{
				$newvalue = preg_replace('/[^A-Za-z.@,:+0-9\-]/', ' ', $value);
				$where[] = "$key = '$newvalue'";
			}
		$sql = "delete from". $table_name ." WHERE " .implode('and ', $where);
		$res =mysqli_query($con,$sql) or die("Error in Getting Data". mysqli_error($con));
		$num = mysqli_affected_rows($con);
		if($num >=1)
		{
		 $result['id']=$id;
		 $result['status']='success';
		 $result['msg'] =$num. " Record deleted successfully";
		}else{
			$result['id']=$id;
			$result['status']='error';
			$result['msg'] = "Soory ! No Record found to delete";
		}
		return $result;
	}
		
function get_all( $table_name, $column_list ='*', $whereArr =null )
	{
		global $con;
		if($column_list <>'*'){
			$column_list =implode(',',$column_list);
		}
		
		if($whereArr <>null)
		{	
			foreach($whereArr as $key=>$value) 
			{
				$key =trim($key);
				$newvalue = preg_replace('/[^A-Za-z.@,:+0-9\-]/', ' ', $value);
				$where[] = "$key = '$newvalue'";
			}
			$sql = "SELECT $column_list FROM $table_name where " .implode('and ', $where);
		}
		else{
			$sql = "SELECT $column_list FROM $table_name where status <>'AUTO' ";
		}
		
		$res = mysqli_query($con,$sql) or die("Error In Loading Data : ".mysqli_error($con));
		$ct =mysqli_num_rows($res);
		if ($ct >=1)
		{
			while($row =mysqli_fetch_assoc($res))
			{
				$data[] = $row;
			}
			$result['count']=$ct;
			$result['status']='success';
			$result['data'] =$data;
		}	
		else{
			$result['count']=0;
			$result['status']='error';
			$result['data'] =null;
		}
		return $result;
	}
	
function direct_sql($sql, $type='get')
	{
		global $con;
		$res = mysqli_query($con,$sql) or die("Error In Loding Data : ".mysqli_error($con));
		if($type=='set')
		{
			$ct =mysqli_affected_rows($con);
		}else{
			$ct =mysqli_num_rows($res);	
		}
		if ($ct >=1)
			{
				while($row =mysqli_fetch_assoc($res))
				{
					$data[] = $row;
				}
			$result['count']=$ct;
			$result['status']='success';
			$result['data']=$data;
			}	
		else{
			$result['count']=0;
			$result['status']='error';
			$result['data']=null;
			}	
		return $result;
	}
function get_data($table_name, $id , $field_name =null, $pkey ='id')
	{
		global $con;
		$result['count'] =0;
		$result['status'] ='error';
		$sql = "SELECT * FROM $table_name where $pkey ='$id' ";
		$res = mysqli_query($con,$sql) or die(" Data Information Error : ".mysqli_error($con));
		$ct = mysqli_num_rows($res);
		$result['count']=$ct;
		if ($ct >=1)
		{
		$row =mysqli_fetch_assoc($res);
		extract($row);
			if($field_name)
			{
			$result['status']='success';
			$result['data'] = $row[$field_name];
			}
			else{
				$result['status']='success';
				$result['data'] = $row;
			}
		}else{
			$result['count'] =0;
			$result['status']='success';
			$result['data'] = null;
		}
	return $result;
	}
function get_multi_data( $table_name, $whereArr , $order =null )
	{
		global $con;
		
		foreach($whereArr as $key=>$value) 
			{
				$newvalue = preg_replace('/[^A-Za-z.@_,:+0-9\-]/', ' ', $value);
				$where[] = "$key = '$newvalue'";
			}
		
	    $sql = "select * from ". $table_name. " WHERE " .implode('and ', $where) .$order ;
		$res=mysqli_query($con,$sql) or mysqli_error($con);
		$num = mysqli_num_rows($res);
		if($num>0)
		{
			while($row =mysqli_fetch_assoc($res))
			{
				$data[] =$row;
			}
			$result['status'] ='success';	
			$result['count'] = $num;
			$result['data'] = $data;
			
		}
		else{
			$result['status'] ='error';	
			$result['count'] = 0;
			$result['data'] = mysqli_error($con);
		}
		return $result;	
	}		
function get_array($table_name, $id, $field_name =null)
	{
		global $con;
		$sql = "SELECT * FROM $table_name where id ='$id' ";
		$res = mysqli_query($con,$sql) or die(" Student Information Error : ".mysqli_error($con));
		if (mysqli_num_rows($res) >=1)
		{
		$row =mysqli_fetch_assoc($res);
		extract($row);
			if($field_name)
			{
			return $row[$field_name];
			}
			else{
				return $row;
			}
		}else{
			return " No Record Found";
		}
	}
	
function removespace($str)
		{
		$str =trim($str);
		return strtolower(preg_replace("/[^a-zA-Z0-9]+/", "_", $str));
		}
		
function addspace($str)
		{
		$str =trim($str);
		return ucwords(str_replace('_', ' ', $str));
		}
		
function dropdown($array_list, $selected =null)
		{
			foreach($array_list as $list)
			{
				?>
				<option value='<?php echo $list; ?>' <?php if($list ==$selected) echo "selected"; ?>><?php echo $list; ?></option>
				<?php
			}
		}

function dropdownwithkey($array_list, $selected =null)
		{
			foreach($array_list as $list)
			{
				$key = array_search ($list, $array_list);
                ?>
				<option value='<?php echo $key; ?>' <?php if($key ==$selected) echo "selected"; ?>><?php echo $list; ?></option>
				<?php
			}
		}
		
function dropdownwhere($table_name,$id,$list,$whereArr, $selected =null)
	{
			global $con;

				foreach($whereArr as $key=>$value)
			{
			$newvalue = post_clean($value);
			$where[] = "$key = '$newvalue'";
			}

			$sql = "select * from ".  $table_name ." WHERE " .implode('and ', $where);
			$res=mysqli_query($con,$sql) or mysqli_error($con);
			while($row =mysqli_fetch_array($res))
			{
			$id_inner =$row[$id];
			$show =$row[$list];
			?>
			<option value='<?php echo $id_inner; ?>' <?php if($id_inner ==$selected) echo "selected";?> ><?php echo $show; ?></option>
			<?php
			}
	}
	
function dropdownmultiple($array_list, $selectedArr =null)
		{
			foreach($array_list as $list)
			{
				//$key=-1;
				$key = array_search ($list, $selectedArr);
                ?>
				<option value='<?php echo $list; ?>' <?php if($key !='') echo "selected"; ?>><?php echo $list ."-".$key; ?></option>
				<?php
			}
		}

function checklist($name, $array_list, $selected=null, $height='160px' )
		{
			$selected = explode(',',$selected);
			echo "<div style='overflow-y:auto;height:$height'>";
			?>
			<span class='btn btn-sm btn-info float-right'  onclick="selectall('<?php echo $name;?>')" ><i class='fa fa-check'></i></span><hr>
			<?php
			foreach(array_filter($array_list) as $list)
			{
				$checked =null;
				$x = array_search(trim($list), array_map('trim', $selected));
				
				if( $x >=-1){ $checked ='checked';}
				?>
				<div class="checkbox">
					  <input type="checkbox" value="<?php echo $list;?>" id="Checkbox_<?php echo $list;?>" <?php echo $checked; ?> name='<?php echo $name.'[]';?>'> 
					  <label for="Checkbox_<?php echo $list;?>"><?php echo $list?></label>
				</div>
				<?php
			}
			echo "</div>";
		}
		
function create_list($table_name, $field,  $whereArr =null)
		{
		global $con;
		$cols = array();
 		
		
		if($whereArr != null)
		{
			foreach($whereArr as $key=>$value) 
				{
					$newvalue = preg_replace('/[^A-Za-z.@,:+0-9\-]/', ' ', $value);
					$where[] = "$key = '$newvalue'";
				}
			$sql = "select distinct($field) from ". $table_name ." WHERE " .implode('and ', $where);
				
		}
		else{
			$sql = "select distinct($field) from ". $table_name;
		}
	
		$res = mysqli_query($con,$sql) or die(" Error IN create List : ".mysqli_error($con));
			if (mysqli_num_rows($res)>=1)
			{
				while($row =mysqli_fetch_assoc($res))
				{
					$list[] =$row[$field];
				}
			}
			else{
				return null;
			}
		return $list;
		}

function countr($table, $col_name)
		{
		global $con;
		$query ="select count($col_name) from $table";
		
		$res = mysqli_query($con,$query) or die(" User Information Error : ".mysqli_error($con));
		$row =mysqli_fetch_assoc($res);
		return mysqli_num_rows($res);
		}

function get_bal()
		{
		global $auth_key;	
		$api_url = 'http://mysms.msgclub.net/rest/services/sendSMS/getClientRouteBalance?AUTH_KEY='.$auth_key;
		//  Initiate curl
		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$api_url);
		// Execute
		$result=curl_exec($ch);
		// Closing
		curl_close($ch);
		$data  =json_decode($result,true);
		return $data[0]['routeBalance'];	
		}	
		


function uploadimg ($file_name , $imgkey = 'rand', $target_dir = "upload")
    {
		if (!file_exists($target_dir)) {
			mkdir($target_dir, 0755, true);
		}
        if ($imgkey =='rand') { $imgkey = rand(10000,99999); }
        $target_file = $imgkey."_". basename($_FILES[$file_name]["name"]);
		$target_file = strtolower(preg_replace("/[^a-zA-Z0-9.]+/", "", $target_file));
        $uploadOk = 1;
		
		$res['id'] =0;
		$res['status'] ='error';
		$res['msg'] ='';
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        
            $check = getimagesize($_FILES[$file_name]["tmp_name"]);
            if($check !== false) {
                $res['msg']= "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $res['msg']= "File is not an image.";
                $uploadOk = 0;
            }
        
        // Check if file already exists
        if (file_exists($target_file)) {
            unlink($target_file);
            $res['msg']= "Sorry, file already exists.";
            $uploadOk = 1;
        }
        // Check file size
        if ($_FILES[$file_name]["size"] > 500000) {
            $res['msg']= "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "pdf" ) {
            $res['msg']= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $msg= "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES[$file_name]["tmp_name"],$target_dir."/".$target_file)) {
                $res['msg'] = "The file ". basename( $_FILES[$file_name]["name"]). " has been uploaded.";
                $res['id'] = $target_file;
				$res['status'] ='success';
            } else {
                $res['msg']= "Sorry, there was an error uploading your file.";
            }
        }
		return $res;
    }


function rowcount($table, $field_name='id')
{
	global $con;
	$query ="SELECT distinct($field_name) from $table";
	$res = mysqli_query($con,$query) or die(" Count Error : ".mysqli_error($con));
	$count  = mysqli_num_rows($res);
	return $count;
}	

function rtfmail($to, $subject, $msg)
{
	global $inst_logo;
	global $inst_name;
	global $inst_email;
	global $inst_url;
	global $base_url;
	global $inst_address1;
	global $inst_address2;
	global $noreply_email;
	//global $app_link;
	
	$from = $noreply_email;
	 
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	 
	// Create email headers
	$headers .= 'From: '.$from."\r\n".
		'Reply-To: '.$from."\r\n" .
		'X-Mailer: PHP/' . phpversion();
	 
	// Compose a simple HTML email message
	$message = '<html><body>';
	$message .= "<table width='1000px' cellpadding='20px' cellspacing='0px' border='0' rules='all'>";
	$message .= "<tr><td colspan='3' aling='center' valign='middle'><img src='".$base_url.$inst_logo."' alt='".$inst_name."' height='80px' /></td><td colspan='2'> <h3>$inst_name </h3> </td></tr>";

	$message .= "<tr><td colspan='5' aling='center' valign='top' height='350px'><p> $msg </p></td></tr>";
	$message .= "<tr><td colspan='5' bgcolor='lightgreen' align='left'>Regards, <br> $inst_name <br> $inst_address1 $inst_address2 <br> $inst_email  | $inst_url | $app_link </td></tr>";
	$message .= '</table>';
	$message .= '</body></html>';
	 
	// Sending email
	if(mail($to, $subject, $message, $headers)){
		$res = 'Your mail has been sent successfully.';
	} else{
		$res =  'Unable to send email. Please try again.';
	}
	return $res;
}


function dropdownlist($tablename,$value,$list,$selected =null, $list2=null)
		{
		global $con;
		$i =0;
		$query ="select * from $tablename where status ='ACTIVE' order by $list";
		$res = mysqli_query( $con,$query) or die(" Creating Drop down Error : ".mysqli_error($con));
		while($row =mysqli_fetch_array($res))
		{
			$key =$row[$value];
			$show =$row[$list];
			
			if($list2 <> null)
			{
				$list2 = "[ " . $row[$list2]. "]";
			}
			
		?>
		<option value='<?php echo $key; ?>'<?php if($key ==$selected) echo "selected";?> ><?php echo $show ." ". $list2; ?></option>
		<?php
		}		
		}

function api_call ($api_url)
		{
		//  Initiate curl
		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$api_url);
		// Execute
		$result=curl_exec($ch);
		// Closing
		curl_close($ch);
		return $result;
		}

function csvexport ($table_name, $col_list ='*')
{
	global $con;
	global $db_name;
	$filename = $table_name.".csv";
	$fp = fopen('php://output', 'w');
	
	if($col_list =='*')
	{
	$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$db_name' AND TABLE_NAME='$table_name'";
	$result = mysqli_query($con,$query);
	while ($row = mysqli_fetch_row($result)) {
		$header[] = $row[0];
	}
	}
	else{
		$header =explode(',',$col_list);
	}	

	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename='.$filename);
	fputcsv($fp, $header);

	$query = "SELECT $col_list FROM $table_name";
	$result = mysqli_query($con, $query);
	while($row = mysqli_fetch_row($result)) {
		fputcsv($fp, $row);
	}
	//exit;
}


function csvimport($table, $pkey='id') // Import CSV FILE to Table
	{
		 // Allowed mime types
   		 $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    	// Validate whether selected file is a CSV file
    	if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
			$change =$new=0;
			if(is_uploaded_file($_FILES['file']['tmp_name'])){
						
				// Open uploaded CSV file with read-only mode
				$csvFile = fopen($_FILES['file']['tmp_name'], 'r');
				$col_list= array_map('trim',fgetcsv($csvFile));
				print_r($col_list);
				while(($line = fgetcsv($csvFile)) !== FALSE){
					$all_data = array_combine($col_list,$line);
					//$search[$pkey] =trim($all_data[$pkey]);
					//$search_result = get_all($table,'*', $search, $pkey);
					$search_result = get_data($table,$all_data[$pkey],null,$pkey);
						echo "<pre>";
						print_r($search_result);
						if($search_result['count']<1)
						{
							$res= insert_data($table,$all_data);
							if($res['id']!=0)
							{
								$new++;	
							}		
						}
						else{
							//echo $all_data[$pkey];
							$res =update_data($table,$all_data, $all_data[$pkey],$pkey);
							if($res['status']=='success')
							{
								$change++;
							}
						}
						$res = array( 'status'=>'success', 'change'=>$change ,'new'=>$new ,'msg'=>" $new New Data and $change change found and updated."); 
				}
			}
			
		}
		else{
			$res = array( 'status'=>'error', 'change'=>$change ,'new'=>$new ,'msg'=>'Please upload a valid CSV file.'); 
			}
		return  $res;
	}	
	
function qrcode( $data) {
	
	$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'qrcode'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'qrcode/';

    include "assets/lib/qrlib.php";    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR)) mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    $errorCorrectionLevel = 'H';
    $matrixPointSize = 4;
   
    if (isset($data)) { 
    
        //it's very important!
        if (trim($data) == '')
            die('data cannot be empty! <a href="?">back</a>');
            
        // user data
        $filename = $PNG_TEMP_DIR.'OFFERPLANT'.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    } else {    
    
        //default data
        echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    }       
    //display generated file
    //echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" />';  
    return $PNG_WEB_DIR.basename($filename);  
    }
	
function getvid($url)
		{
			parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
			return $my_array_of_vars['v'];    
		}

function get_bal_msg()
		{
		global $auth_key_msg;	
		$api_url = 'http://mysms.msgclub.net/rest/services/sendSMS/getClientRouteBalance?AUTH_KEY='.$auth_key_msg;
		//  Initiate curl
		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$api_url);
		// Execute
		$result=curl_exec($ch);
		// Closing
		curl_close($ch);
		$data  =json_decode($result,true);
		return $data[0]['routeBalance'];	
		}	
		

function get_bal_sms()
		{
		global $auth_key_sms;	
		$api_url = 'http://sms.morg.in/api/balance.php?&type=4&authkey='.$auth_key_sms;
		//  Initiate curl
		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$api_url);
		// Execute
		$result=curl_exec($ch);
		// Closing
		curl_close($ch);
		$data  =json_decode($result,true);
		return $data;	
		}	
		
function bulk_msg($mobile_list, $sms, $count =1,  $smstype ='english')
{
	global $auth_key_msg;
	global $sender_id;
	
        $data  = array('smsContent'=>$sms, 'groupId'=>'', 'routeId'=>1,'mobileNumbers'=>$mobile_list,'senderId' =>$sender_id,'signature'=>'','smsContentType'=>$smstype);
        $text_sms  =json_encode($data);
        $curl = curl_init();
          curl_setopt_array($curl, array(
          CURLOPT_URL => "http://msg.morg.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=$auth_key_msg",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $text_sms,
          CURLOPT_HTTPHEADER => array(
            "Cache-Control: no-cache",
            "Content-Type: application/json"
            ),
            ));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		$res['status'] ='error';
		$res['count'] =0;
		$res['msg'] =$err;
	} else {
	  
		$res['status'] ='success';
		$res['count'] =$count;
		$res['msg'] = $count ."SMS Send Successfully";
	}
	return $res;
}
function bulk_sms($mobileNumber, $message)
{
		global $auth_key_sms ; //$authKey ;
		global $sender_id ; //$senderId ;

		//Your message to send, Add URL encoding here.
		$message = urlencode($message);

		//Define route 
		$route = "4";
		//Prepare you post parameters
		$postData = array(
			'authkey' => $auth_key_sms,
			'mobiles' => $mobileNumber,
			'message' => $message,
			'sender' => $sender_id,
			'route' => $route
		);

		//API URL
		$url="http://sms.morg.in/api/sendhttp.php";
		// init the resource
		$ch = curl_init();
		curl_setopt_array($ch, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $postData
			//,CURLOPT_FOLLOWLOCATION => true
	));

	//Ignore SSL certificate verification
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	//get response
	$output = curl_exec($ch);
	//Print error if any
	if(curl_errno($ch))
	{
		echo 'error:' . curl_error($ch);
	}
	curl_close($ch);
	echo $output;
}
function send_msg($number,$sms)
		{
			$res =null;
		if(preg_match('/^[6-9]{1}[0-9]{9}+$/', $number) ==1)
			{
			$no ='91'.urlencode($number);
			$msg = substr(urlencode($sms),0,340);
			global $sender_id;
			global $auth_key_msg;
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	    	$url ="http://msg.morg.in/rest/services/sendSMS/sendGroupSms?AUTH_KEY=$auth_key_msg&message=$msg&senderId=$sender_id&routeId=1&mobileNos=$no&smsContentType=english";
			curl_setopt($ch,CURLOPT_URL, $url);
	    	$res= curl_exec($ch);
			curl_close($ch);
			
			}
			return $res;
		}	
		
function send_sms($number,$sms)
		{
		    global $req_by;
		    global $ctime;
		    global $dlt;
			$res =null;
		if(preg_match('/^[6-9]{1}[0-9]{9}+$/', $number) ==1)
			{
			$no =urlencode($number);
			$sms ="Dear ". $sms . " Via OFFSMS";
			$msg = substr(urlencode($sms),0,340);
			insert_data('sms_log',array('mobile'=>$no,'text'=>$msg,'created_by'=>$req_by,'created_at'=>$ctime));
			global $sender_id;
			global $auth_key_sms;
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$url ="http://sms.morg.in/api/sendhttp.php?authkey=$auth_key_sms&mobiles=$no&message=$msg&sender=$sender_id&route=4&country=91&DLT_TE_ID=$dlt";
	    	curl_setopt($ch,CURLOPT_URL, $url);
	    	$res= curl_exec($ch);
			curl_close($ch);
			
			}
			return $res;
		}		

/* =============== END of OfferPlant Master Function ===============*/

/*---------Ecommerce SYSTEM -------------------------*/

function new_customer($table_name )
	{
		global $con;
		global $token;
		$result = get_multi_data($table_name, array('token'=>$token,'status'=>'AUTO'), ' order by id desc limit 1');
		if($result['count'] <1) 
		{
		$result = insert_data( $table_name, array('token'=>$token,'status'=>'AUTO','created_at'=>date('Y-m-d h:i:s')));
		$id = $result['id'];
		}
		else{
			$id = $result['data'][0]['id'];
		}		
		$_SESSION['visitor_id'] =$id;
		return array('table'=>$table_name,'id'=>$id);
	}

function dcharge($order_amt)
{
	if($order_amt<150)
	{
		$dcharge =30;
	}
	else{
		$dcharge=0;
	}
	return $dcharge;
}


/* Account & Transaction */

function invopen($member_id)
		{
		global $con;
		$invoice  = direct_sql("select * from invoice where status='OPEN' and member_id ='$member_id' order by id desc limit 1");
			if($invoice['count'] ==0)
			{
				$inv_data = array('member_id'=>$member_id,'invoice_date'=>date('Y-m-d'), 'status'=>'OPEN');
				$res = insert_data('invoice',$inv_data);
				$result['id'] =$res['id'];
				$result['status'] ='NEW';
			}
			else{
				$inv_data  = $invoice['data'][0];
				$result['id'] =$inv_data['id'];
				$result['status'] ='EXISTING';
			}
		return $result;	
		}

function lastid ($center_id)
{
	$student_id  = direct_sql("select * from student where center_id='$center_id' order by student_id desc limit 1");
	return $student_id['data'][0]['student_roll'];
}

function walletplus($member_id, $amount, $txn_mode ='Amount added to Wallet' , $txn_remarks=null)
{
	global $today;
	$plan = get_all('recharge','*', array('amount'=>$amount));
	if($plan['count']>0)
	{
	    $data = $plan['data'][0];
	    $amount = $data['wallet'];
	    $member = get_data('member',$member_id)['data'];
	    /*if($member['expiry_date'] !='0000-00-00' or $member['expiry_date']!='')
	        { 
	            $new_expiry_date = date('Y-m-d', strtotime($plan['validity'] .' months' ,strtotime($member['expiry_date'])));
	            update_data('member' , array('expiry_date'=>$new_expiry_date), $member_id);
	        }
		else{
		     $new_expiry_date = date('Y-m-d', strtotime($plan['validity'] .' months' ,strtotime($member['joining_date'])));
	            update_data('member' , array('expiry_date'=>$new_expiry_date), $member_id);
		    }*/
		$txn_mode =$data['name'] ." [".$data['amount'] ."] Activated";
	}
	$member =get_data('member',$member_id)['data'];
	$current_wallet = $member['current_wallet'];
	$nbal =$current_wallet + $amount;
	$wdata =array('txn_mode' =>$txn_mode, 'credit_amt'=>$amount,'member_id'=>$member_id,'txn_remarks'=> $txn_remarks, 'txn_date'=>$today,'status'=>'SUCCESS','balance'=>$nbal);
	$res1 =insert_data('wallet', $wdata);
	if($res1['id']>0)
	{
		$res3 = update_data('member',array('current_wallet'=>$nbal),$member_id);
	}
	return $nbal;
}

function walletminus($member_id, $amount, $txn_mode ='Paid from Wallet' , $txn_remarks=null)
{
	global $today;
	$member =get_data('member',$member_id)['data'];
	$current_wallet = $member['current_wallet'];
	$nbal =$current_wallet - $amount;
	$wdata =array('txn_mode' =>$txn_mode, 'debit_amt'=>$amount,'member_id'=>$member_id,'txn_remarks'=> $txn_remarks, 'txn_date'=>$today,'status'=>'SUCCESS','balance'=>$nbal);
	$res1 =insert_data('wallet', $wdata);
	if($res1['id']>0)
	{
		$res3 = update_data('member',array('current_wallet'=>$nbal),$member_id);
	}
	return $nbal;
}

function invoice_no($inv_id)
    {
        $inv = get_data('invoice', $inv_id)['data'];
        $inv_date = $inv['invoice_date'];
        //$res = get_all('invoice', '*', array('invoice_date'=>$inv_date));
        $sql ="select * from invoice where invoice_date ='$inv_date' and id < '$inv_id'";
        $res = direct_sql($sql);
        
        $id  =$res['count']+1;
        $invoice_no = substr($inv['invoice_type'],0,2)."-".date('ymd', strtotime($inv_date)).str_pad($id, 3, "0", STR_PAD_LEFT);
        update_data('invoice', array('invoice_no'=> $invoice_no), $inv_id);
        return $invoice_no;
    }
?>