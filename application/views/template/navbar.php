<div class="container top" style="background:#daa520;" >
<nav class="navbar navbar-default">
  
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <!--<a class="navbar-brand" href="#">WebSiteName</a>-->
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="<?php if($link=='depan'){echo'active';}?>">
          <?php if(!$this->session->userdata('is_login') || $this->session->userdata('level') != 'admin'){ ?>
          <a href="<?=base_url()?>depan">Home</a>
          <?php }else{?>
          <a href="<?=base_url()?>admin">Home</a>
          <?php }?>
        </li>
        </li>
            

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if(!$this->session->userdata('logged_in')){?>

                    <li><a href="<?=base_url()?>log_in">Login</a></li>
       
        <?php }else{?>
        <li><a href="http://sso.itera.ac.id/"><span class="glyphicon glyphicon-user"></span> <?=$this->session->userdata('username')?></a></li>
        <li><a href="<?=base_url()?>log_in/signout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
        <?php }?>

      </ul>
    </div>
  
</nav>
</div>
    

<div class="container" style="background:#fff;min-height:500px; box-shadow:0px -6px 22px 0px rgba(0, 0, 0, 0.2);">
    <div class="row">