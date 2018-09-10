<div class="col-md-3">
<br/>
<?php if ($this->session->userdata('level_ppm') == 'admin') {?>

<div class="list-group">
  <a href="#" class="list-group-item list-group-item-warning"> PPM</a>
  <a href="<?=base_url()?>admin" class="list-group-item <?php if($link=='beranda'){echo'active';}?>"><i class="fa fa-dashboard" aria-hidden="true"></i> Beranda</a>
  <a href="<?=base_url()?>admin/penelitian" class="list-group-item <?php if($link=='penelitian'){echo'active';}?>"><i class="fa fa-files-o" aria-hidden="true"></i> Daftar Usulan Penelitian</a>
    <a href="<?=base_url()?>admin/pengabdian" class="list-group-item <?php if($link=='pengabdian'){echo'active';}?>"><i class="fa fa-file-o" aria-hidden="true"></i> Daftar Usulan Pengabdian</a>
  <a href="<?=base_url()?>admin/posting" class="list-group-item <?php if($link=='posting'){echo'active';}?>"><i class="fa fa-th-list" aria-hidden="true"></i> Posting</a>          
</div>
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-warning">Report</a>
  <a href="<?=base_url()?>admin/rekap_proposal" class="list-group-item <?php if($link=='rekap_proposal'){echo'active';}?>"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Rekap Proposal</a> 
  <a href="<?=base_url()?>admin/rekap_nilai" class="list-group-item <?php if($link=='rekap_nilai'){echo'active';}?>"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Rekap Nilai</a> 
</div>
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-warning">Master Referensi</a>
  <a href="<?=base_url()?>admin/reviewer" class="list-group-item <?php if($link=='reviewer'){echo'active';}?>"><i class="fa fa-bookmark" aria-hidden="true"></i> Daftar Reviewer</a>
  <a href="<?=base_url()?>admin/kategori" class="list-group-item <?php if($link=='kategori'){echo'active';}?>"><i class="fa fa-book" aria-hidden="true"></i> Daftar Kategori</a>    
</div>



<?php } ?>

<?php if ($this->session->userdata('rule') == 'dosen') {?>
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-warning">Usulan Proposal</a>
   <a href="<?=base_url()?>user" class="list-group-item <?php if($link=='beranda'){echo'active';}?>"><i class="fa fa-dashboard" aria-hidden="true"></i> Beranda</a>
  <a href="<?=base_url()?>user/penelitian" class="list-group-item <?php if($link=='penelitian'){echo'active';}?>"><i class="fa fa-file-text" aria-hidden="true"></i> Penelitian</a>
   <a href="<?=base_url()?>user/pengabdian" class="list-group-item <?php if($link=='pengabdian'){echo'active';}?>"><i class="fa fa-file-text-o" aria-hidden="true"></i> Pengabdian</a>
  <a href="<?=base_url()?>user/list_proposal" class="list-group-item <?php if($link=='list_proposal'){echo'active';}?>"><i class="fa fa-users" aria-hidden="true"></i> Keanggotaan Proposal</a>
          
</div>

<?php } ?>

<?php if ($this->session->userdata('rule') == 'reviewer') {?>
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-warning">Review Proposal</a>
   <a href="<?=base_url()?>reviewer/beranda" class="list-group-item <?php if($link=='beranda'){echo'active';}?>"><i class="fa fa-dashboard" aria-hidden="true"></i> Beranda</a>
   <a href="<?=base_url()?>reviewer/penilaian_penelitian" class="list-group-item <?php if($link=='penilaian_penelitian'){echo'active';}?>"><i class="fa fa-file-text" aria-hidden="true"></i> Penilaian Penelitian</a>
    <a href="<?=base_url()?>reviewer/penilaian_pengabdian" class="list-group-item <?php if($link=='penilaian_pengabdian'){echo'active';}?>"><i class="fa fa-file-text-o" aria-hidden="true"></i> Penilaian Pengabdian</a>
    <a href="<?=base_url()?>reviewer/reset" class="list-group-item <?php if($link=='reset'){echo'active';}?>"><i class="fa fa-refresh" aria-hidden="true"></i> Reset Password</a>
            
</div>

<?php } ?>

</div>







