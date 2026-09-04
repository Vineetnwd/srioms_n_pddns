<?php require_once('header.php'); 
if(isset($_SESSION['user_id']))
{
	echo "<script> window.location ='index' </script>";
}
?>
<style>
.bglogin{

background: linear-gradient(210deg, rgba(31,160,19,1) 24%, rgba(5,160,192,1) 100%) ;
background:url('assets/img/back.jpg') 50% 50%;
background-size:100% 100%;
}
</style>
<body class="bg-login bg-light" id='login-page'>

        <div class="container h-100">
        <div class="row h-100  align-items-center">
            <div class="col-md-4"></div>
            <div class="col-md-4">
               
                <div class="card" id='login-area' >
                    <div class="card-body" style='opacity:0.95'>
                    <h4 class="text-center mb-4"><img src='assets/img/logo.png' width='160px' class='rounded'></h4> <hr>
                        <form id='login_frm'>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Username" name='user_name' required minlength='3'>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="Password" name='user_pass' required minlength='3'>
                            </div>

                            <div class="row">
                                <div class="col pr-2">
                                    <button type="button" class="btn btn-block btn-success" id='login_btn'> Secure Login</button>
                                </div>
                                <div class="col pl-2">
                                    <a class="btn btn-block btn-link" id='forget_password'>Forgot Password</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('footer.php'); ?>