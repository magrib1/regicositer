<div class="col-md-3">
<br/>
<?php if ($this->session->userdata('level') == 'admin') {?>

<div class="list-group">
  <a href="#" class="list-group-item list-group-item-warning"> PPM</a>
  <a href="<?=base_url()?>admin" class="list-group-item <?php if($link=='beranda'){echo'active';}?>"><i class="fa fa-dashboard" aria-hidden="true"></i> Beranda</a>
  <a href="<?=base_url()?>admin/fullpaper" class="list-group-item <?php if($link=='fullpaper'){echo'active';}?>"><i class="fa fa-files-o" aria-hidden="true"></i> Daftar FullPaper</a>
    <a href="<?=base_url()?>admin/payment" class="list-group-item <?php if($link=='payment'){echo'active';}?>"><i class="fa fa-money" aria-hidden="true"></i> Daftar Payment</a>
  <a href="<?=base_url()?>admin/user" class="list-group-item <?php if($link=='user'){echo'active';}?>"><i class="fa fa-user" aria-hidden="true"></i> User</a>          
</div>



<?php } ?>



</div>







