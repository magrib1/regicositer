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
          <?php if(!$this->session->userdata('is_login') || $this->session->userdata('level_repo') != 'admin'){ ?>
          <a href="<?=base_url()?>depan">Home</a>
          <?php }else{?>
          <a href="<?=base_url()?>admin">Home</a>
          <?php }?>
        </li>
        </li>
        <li class="<?php if($link=='about'){echo'active';}?>"><a href="<?=base_url()?>depan/about">About</a></li>
        

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if(!$this->session->userdata('logged_in')){?>
        
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-log-in"></span> Login
             <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?=base_url()?>login/login">As Author</a></li>
                    <li><a href="<?=base_url()?>log_in">As Reviewer</a></li>
                </ul>
        </li>
        <?php }else{?>
        <li><a href="http://sso.itera.ac.id/"><span class="glyphicon glyphicon-user"></span> <?=$this->session->userdata('name')?></a></li>
        <li><a href="<?=base_url()?>login/signout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
        <?php }?>

      </ul>
    </div>
  
</nav>
</div>
    

<div class="container" style="background:#fff;min-height:500px; box-shadow:0px -6px 22px 0px rgba(0, 0, 0, 0.2);">
    <div class="row">