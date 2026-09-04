<?php 
include('function.php');

$param = decode($_GET['link']);

$table = $param['table'];
$id = $param['id'];

$res = get_data($table, $id);
if($res['status']=='success')
{
    $data =$res['data'];
    unset($data['id']);
    unset($data['created_by']);
    unset($data['created_at']);
    unset($data['updated_at']);
    unset($data['updated_by']);
}
?>

<style>
body {
  -webkit-user-select: none;
     -moz-user-select: -moz-none;
      -ms-user-select: none;
          user-select: none;
}

@media print {
         body {display:none;}
      }
</style>
<script>
document.addEventListener('contextmenu', event => event.preventDefault());
</script>
    <div class="content p-2 bg-light ">
		
				<?php 
				    $info ="<table class='table bg-light' >";
			    foreach ($data as $key => $value) 
			    {
			        if($key =='photo')
			        {
			            $display_key = addspace($key);
			            $display_val = "<img src='upload/".$value."' width='100px' class='img-thumbnail' onError ='showimgerror()'>";
			        }
			         else if($key =='docs')
			        {
			            $display_key = addspace($key);
			            $display_val = "<img src='upload/".$value."' width='100px' class='img-thumbnail'>";
			        }
			        else if($key =='ref_by' and $value !=0 )
			        {
			            $display_key ='Ref By';
			            $display_val = get_data('member',$value,'name')['data'];
			        }
                    else if(strpos($key,'date') && $value !=null)
			        {
			            $display_key = addspace($key);
			            $display_val = date('d-M-Y', strtotime($value));
			        }
			        else{
			        $display_key = addspace($key);
			        $display_val = wordwrap($value,55,'<br>',true);
			        }
			        
			        $info = $info."<tr><td><b>".$display_key."</b></td><td>".$display_val ."</td></tr>";
			    }
			    $info =$info."</table>";
			    
			    echo $info;
			    ?>
		
    </div>
