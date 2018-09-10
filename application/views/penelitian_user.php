<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-list-alt" aria-hidden="true"></i> Daftar Usulan
    <?php 
    $cek_ketua = $this->Model->ambil_banyak_kondisi('tb_usulan_proposal', array('ketua_peneliti' => $this->session->userdata('id'), 'jenis' => 'penelitian', 'delete' => '0', 'status' => 'diterima', 'didanai' => 'didanai') )->num_rows();
    $waktu_sekarang = time();
    $waktu_akhir = $this->Model->ambil('jenis','penelitian','tb_timeline')->row();
    $waktu_akhir = strtotime($waktu_akhir->waktu_selesai);
    // var_dump($waktu_sekarang);
    // var_dump($waktu_akhir);

    if ($cek_ketua < 1 && $waktu_sekarang  < $waktu_akhir) {
   
    ?>
       	<div style="float:right;">
        <a href="<?=base_url()?>user/penelitian/create_usulan" id="tambah_mod_usulan" href="#" data-toggle="modal" style="text-decoration:none;" class="btn btn-primary btn-xs"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Data</a>
        </div>
        <?php }?>

	</div>
	<div class="panel-body">
    <?php if($waktu_sekarang  > $waktu_akhir){?>
    <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Batas waktu Submit Proposal telah Berakhir !</div>
    <?php }?>
		<table id="daftar" class="table table-striped table-bordered table-hover">
			<thead>
        <tr>
          <th width="col-md-1">No</th>
          <th width="col-md-7">Judul Penlitian</th>
          <th width="col-md-2">Status</th>
          <th width="col-md-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no=1;
        foreach($list as $l){
          if ($l->status == 'diterima') {
            $status = 'Diterima Desk Evaluation';
          }elseif($l->status == 'ditolak'){
            $status = 'Ditolak Desk Evaluation';
          }else{
            $status = 'Diusulkan';
          }

          if ($l->didanai == 'didanai') {
          $dana = "Selamat proposal anda didanai";
        }elseif($l->didanai == 'ditolak'){
          $dana = "Mohon maaf proposal anda tidak didanai";
        }else{
          $dana = "";
        }
        ?>
          <?php $file = $this->Model->ambil_banyak_kondisi_order('tb_file_upload', array('id_proposal' => $l->id_proposal), 'waktu_upload', 'DESC' )->row(); ?>
      <tr>
        <td><?=$no++?></td>
        <td><?=$l->judul_penelitian?></td>
        <td><?=$status?> <hr> <?=$dana?></td>
				<td>
        <?php if($l->status == 'diusulkan') {?>
          <?php if($waktu_sekarang  < $waktu_akhir){?>
          <a href="<?=base_url()?>user/penelitian/usulan/<?=$l->id_proposal?>" class="ubah_usulan btn btn-warning btn-xs" id="<?=$l->id_proposal?>" style="text-decoration:none;"><i class="fa fa-pencil-square fa-lg" aria-hidden="true"></i> Ubah</a> | <a href="#" class="hapus_usulan btn btn-danger btn-xs" id="<?=$l->id_proposal?>" data-togle="modal" style="text-decoration:none;"><i class="fa fa-trash fa-lg" aria-hidden="true"></i> Hapus</a> <br>
          <?php }?>
          <a href="<?=base_url()?>/user/penelitian/cetak_pengesahan/<?=$l->id_proposal?>" target="_blank" class="btn btn-success btn-xs" data-togle="modal" style="text-decoration:none;"><i class="fa fa-print fa-lg" aria-hidden="true"></i> Cetak Hal.Pengesahan</a> <br>
          <?php if(empty($file->nama_file)) {?>
          <a href="#upload_proposal" id="<?=$l->id_proposal?>" class="btn btn-info btn-xs upload_proposal" data-togle="modal" style="text-decoration:none;"><i class="fa fa-upload fa-lg" aria-hidden="true"></i> Upload Proposal</a> 
          <?php }else{?>
            <?php if($waktu_sekarang  < $waktu_akhir){?>
            <a href="#lihat_proposal" id="<?=$l->id_proposal?>" class="btn btn-info btn-xs lihat_proposal" data-togle="modal" style="text-decoration:none;"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i> Lihat Proposal</a> 
            <?php }else{?>
            <a href="#lihat_proposal2" id="<?=$l->id_proposal?>" class="btn btn-info btn-xs lihat_proposal2" data-togle="modal" style="text-decoration:none;"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i> Lihat Proposal</a> 
            <?php }?>

          <?php }?>

        <?php }elseif($l->status == 'diterima'){?>
            <a href="<?=base_url()?>user/penelitian/cetak_pengesahan/<?=$l->id_proposal?>" target="_blank" class="btn btn-success btn-xs" data-togle="modal" style="text-decoration:none;"><i class="fa fa-print fa-lg" aria-hidden="true"></i> Cetak Hal.Pengesahan</a> <br>
            <a href="#lihat_proposal2" id="<?=$l->id_proposal?>" class="btn btn-info btn-xs lihat_proposal2" data-togle="modal" style="text-decoration:none;"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i> Lihat Proposal</a> 
            <br>
            <a href="<?=base_url()?>user/penelitian/cek_nilai/<?=$l->id_proposal?>" id="" class="btn btn-default btn-xs" data-togle="modal" style="text-decoration:none;"><i class="fa fa-columns fa-lg" aria-hidden="true"></i> Lihat Nilai</a> 
            <br>
            <a href="#komentar" id="<?=$l->id_proposal?>" class="btn btn-default btn-xs komentar" data-togle="modal" style="text-decoration:none;"><i class="fa fa-commenting-o fa-lg" aria-hidden="true"></i> Komentar</a>
        <?php }else{?>
            <a href="#komentar" id="<?=$l->id_proposal?>" class="btn btn-default btn-xs komentar" data-togle="modal" style="text-decoration:none;"><i class="fa fa-commenting-o fa-lg" aria-hidden="true"></i> Komentar</a> 
        <?php }?>


        </td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Modal Upload Proposal -->
<div class="modal fade" id="upload_proposal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Proposal</h4>
        </div>
        <div class="modal-body">
          <div class="panel-body">
                <form id="form_upload_proposal" method="POST" action="<?=base_url()?>user/penelitian/upload_proposal">
                 <br>
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th class="col-md-4">File Proposal</th>
                        <td class="col-md-8"><input type="file" name="file_proposal" id="file_proposal" class="form-control" required>
                          <input type="hidden" name="id_proposal" id="id_proposal">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div style="min-height:100px; background: #F56954; color: #fff; border-radius:2px; border-bottom: solid 24px #DC5E4B">
                            <p>*ket:</p>
                            <ol>
                                <li>Allowed File : pdf|PDF </li>
                                <li>Max File Size : 2 Mb </li>
                            </ol>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        
                        <td colspan="2">
                          <div id="notif"></div>
                            <div style="float:right;">
                                <input type="submit" name="simpan" value="Upload" class=" btn btn-info btn_upload_proposal">
                                <input type="text" style="display: none" name="id_file_upload" id="id_file_upload"/>
                                <input type="text" style="display: none" name="action" id="action"/>
                            </div>
                        </td>
                    </tr>
                </table>
                </form>
               
          </div>
        </div>
      </div>
    </div>
</div>

<!-- Modal Upload Proposal -->
<div class="modal fade" id="lihat_proposal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Lihat Proposal</h4>
        </div>
        <div class="modal-body">
          <div class="panel-body">
              <div id="result"></div>
               
               <form id="form_delete_proposal" method="POST" action="<?=base_url()?>user/penelitian/hapus_file_proposal">
                <input type="hidden" name="id_proposal_" id="id_proposal_">
                  <div id="notif"></div>
                        <div style="float:right;">
                            <input type="submit" name="hapus" value="Delete" class=" btn btn-danger btn_hapus_proposal">
                        </div>
               </form>
               
          </div>
        </div>
      </div>
    </div>
</div>

<!-- Modal Upload Proposal -->
<div class="modal fade" id="lihat_proposal2" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Lihat Proposal</h4>
        </div>
        <div class="modal-body">
          <div class="panel-body">
              <div id="result2"></div>
               
              
          </div>
        </div>
      </div>
    </div>
</div>

<!-- Modal Upload Proposal -->
<div class="modal fade" id="komentar" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Catatan Admin</h4>
        </div>
        <div class="modal-body">
          <div class="panel-body">
              <div id="result3"></div>
               
              
          </div>
        </div>
      </div>
    </div>
</div>

<!-- Delete Modal -->
    <div class="modal fade" id="modalHapus" role="dialog">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Hapus Data</h4>
            </div>
            <div class="modal-body">
                Anda yakin menghapus data ini ? <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Tidak</button> 
                <button type="button" class="btn btn-danger btn_hapus_usulan">Hapus</button>
                <div id="notif"></div>
                <input type="text" style="display: none" name="id_hapus" id="id_hapus">
            </div>
            
          </div>
        </div>
    </div>
<!--  End Delete Modal -->