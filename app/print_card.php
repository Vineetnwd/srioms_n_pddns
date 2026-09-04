<?php require_once("function.php");	$sid = $_REQUEST['member_id']; 
$data = decode($_GET['link']);

$member = get_data('member', $data['member_id'])['data'];
extract($member);
?>
<script src ='https://html2canvas.hertzen.com/dist/html2canvas.min.js'></script>
<style>
@import url('https://fonts.googleapis.com/css2?family=RocknRoll+One&display=swap');
body{
    font-family: 'RocknRoll One', sans-serif;
    background:#d6d6d6;
    margin-left:50px;
}

.idcard{
    width:85%;
    margin:auto;
    height:650px;
    border-bottom:solid 1px #ddd;
    text-align:center;
    background:#fff;
    padding:20px;
}
.idbox{
    width:640px;
    height:400px;
    background:url('../app/assets/img/card.png');
    background-size:640px 400px;
    color:#f5f5f5;
    font-size:16px;
    position:relative;
}


.ready{
    width:640px;
    height:400px;
    margin-top:40px;
    color:#f5f5f5;
    border:dotted 1px #f00;
    border-radius:5px;
    padding:20px;
}


.photo{
    width:160px;
    height:160px;
    border:solid 1px #ccc;
    float:left;
    margin:20px;
    margin-top:160px;
    border-radius:15px;
}

.info{
    margin-top:150px;
    width:400px;
    height:240px;
    padding:20px;
    position:absolute;
    
    margin-left:250px;
}

.btn{
    background:#18bc9c;
    color:#fff;
    border:solid 1px #ddd;
    padding:5px 10px;
     border-radius:5px;
}

table{
    border:solid 1px #d5d5d5; 
}
td{
    padding:5px;
}
</style>
<title> Create BRIMS ID CARD</title>
        <h2> CREATE BRIMS ID CARD </h2>
    <div class='idbox' id='capture' >
      
        <img src='upload/<?php echo $photo?>' width='80px' height='80px' class='photo' align='left'>
        <!--    -->
    
        <div class='info'>
            <?php echo $name;?><br>
            <span style='color:gold'><?php echo $membership_id;?></span>
            <?php echo $gender;?> <br>
            <?php echo $date_of_birth;?> <br>
            <?php echo date('M Y', strtotime($joining_date)); ?> - <?php echo date('M Y', strtotime($expiry_date)); ?>
        </div>
    </div>
<br>
<input type='button' onclick='capture()' Value='Click to Generate and Right Click on Image to Save or Download' class='btn'>
<br>  
<script>

function capture()
{
html2canvas(document.querySelector("#capture"), {width:640, height: 400,backgroundColor:null}).then(canvas => {
    document.body.appendChild(canvas)
    //document.querySelector("#print").appendChild(canvas)
});
}
</script>
			