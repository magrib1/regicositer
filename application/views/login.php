<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>ITERA - ICOSITER</title>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>   
    <link rel="stylesheet" href="<?php echo base_url();?>assets/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/logo.png">    
    
	<script type="text/javascript">
        $(document).ready(function(){
            $(document).on('submit', '#form_login', function(e){
                e.preventDefault();
                var data = $('#form_login').serialize();
                $('#loading').html('Loading...');
                $.ajax({
                    url: '<?php echo base_url();?>/log_in/signin',
                    type: 'POST',
                    data: data,
                    success: function(msg){
                        $('#loading').html(msg);
                    }
                });
            });
        });
    </script>
    <style>
        .login-block{
            background: #DE6262;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to bottom, #FFB88C, #DE6262);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to bottom, #FFB88C, #DE6262); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        float:left;
        width:100%;
        padding : 50px 0;
        }
        .banner-sec{background:url(<?php echo base_url();?>assets/login.jpg)  no-repeat left bottom; background-size:cover; min-height:500px; border-radius: 0 10px 10px 0; padding:0;}
        .container{background:#fff; border-radius: 10px; box-shadow:15px 20px 0px rgba(0,0,0,0.1);}
        .carousel-inner{border-radius:0 10px 10px 0;}
        .carousel-caption{text-align:left; left:5%;}
        .login-sec{padding: 50px 30px; position:relative;}
        .login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
        .login-sec .copy-text i{color:#FEB58A;}
        .login-sec .copy-text a{color:#E36262;}
        .login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #DE6262;}
        .login-sec h2:after{content:" "; width:100px; height:5px; background:#FEB58A; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
        .btn-login{background: #DE6262; color:#fff; font-weight:600;}
        .banner-text{width:70%; position:absolute; bottom:40px; padding-left:20px;}
        .banner-text h2{color:#fff; font-weight:600;}
        .banner-text h2:after{content:" "; width:100px; height:5px; background:#FFF; display:block; margin-top:20px; border-radius:3px;}
        .banner-text p{color:#fff;}
    </style>
</head>
<body>
    <section class="login-block">
        <div class="container">
        <div class="row">
            <div class="col-md-4 login-sec">
                <h2 class="text-center">Login</h2>
                <form id="form_login">
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="text-uppercase">Username</label>
                    <input type="text" name ="username" id="username" class="form-control" placeholder="">
                    
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1" class="text-uppercase">Password</label>
                    <input type="password" name ="password" id="password" class="form-control" placeholder="">
                  </div>
                  <div id="loading" style="margin:10px 0 9px 0;padding:7px;font-size:11px;text-align:center; max-width:340px"></div>
                  
                    <div class="form-check">
                    
                    <button type="submit" class="btn btn-login float-right">Login</button>
                  </div>
                  
                </form>
            </div>
            <div class="col-md-8 banner-sec">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                     
                <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="img-responsive" src="<?php echo base_url();?>assets/login.jpg" alt="First slide">
              <div class="carousel-caption d-none d-md-block">
                    <div class="banner-text">
                        
                    </div>  
              </div>
            </div>
        
        
                </div>     
                
            </div>
        </div>
    </div>
    </section>
   
</body>
</html>