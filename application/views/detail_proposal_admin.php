<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-list-alt" aria-hidden="true"></i> Detail Proposal (<?=$list->judul_penelitian?>)
		<div style="float:right;">
        <a onClick="javascript: history.go(-1)" style="text-decoration:none;"  class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
        <a href="#" id="<?=$list->id_proposal?>" class="btn btn-success btn-xs pull-right approve" type="button" data-togle="modal"><i class="fa fa-check" aria-hidden="true"></i> Evaluation
        </a>
    </div>
       
	</div>
	<div class="panel-body">
		<?php $scope = $this->Model->ambil('id_kategori',$list->id_kategori,'tb_kategori')->row(); ?>
		<table class="table table-striped table-hover">
			<?php if(!empty($file->nama_file)) {?>
               <object width="100%" height="600" data="<?=base_url()?>assets/file_upload/<?=$file->nama_file?>" type="application/pdf"></object> 
               <?php }else{?>
               <div class="alert alert-dismissible alert-warning">
				  <p>File proposal belum diupload</p>
				</div>
               <?php }?>
			<tr>
				<td class="col-md-3">Judul</td>
				<td class="col-md-9"><?=@$list->judul_penelitian?></td>
			</tr>
			<tr>
				<td class="col-md-3">Ketua Peneliti</td>
				<td class="col-md-9"><?=@$list->nama_ketua_peneliti?></td>
			</tr>
			<tr>
				<td class="col-md-3">Scope</td>
				<td class="col-md-9"><?=@$scope->nama_kategori?></td>
			</tr>
			<tr>
				<td class="col-md-3">Abstrak</td>
				<td class="col-md-9"><?=@$list->abstrak?></td>
			</tr>
			<tr>
				<td class="col-md-3">Keyword</td>
				<td class="col-md-9"><?=@$list->keyword?></td>
			</tr>
			<tr>
				<td class="col-md-3">Tahun Penelitian</td>
				<td class="col-md-9"><?=@date("Y", strtotime($list->tahun_diajukan));?></td>
			</tr>
			<tr>
				<td class="col-md-3">Lama Penelitian</td>
				<td class="col-md-9"><?=@$list->lama_penelitian?> tahun</td>
			</tr>
			<tr>
				<td class="col-md-3">Biaya Diusulkan</td>
				<td class="col-md-9">Rp. <?=@number_format($list->biaya_diusulkan)?></td>
			</tr>
			<tr>
				<td class="col-md-3">Sumber Lain</td>
				<td class="col-md-9">Rp. <?=@number_format($list->sumber_lain)?></td>
			</tr>
			<tr>
				<td class="col-md-3">Afiliasi Dosen</td>
				<td class="col-md-9">
				<?php foreach ($list_afiliasi_dosen as $ld)  {

					if (count($ld->nama_anggota) >=1 ) {
						echo "<i>$ld->nama_anggota <i> <br>";
					}else{
						echo "<i>$ld->nama_anggota <i>";
					}
				
				 } ?>
				</td>
			</tr>
			<tr>
				<td class="col-md-3">Afiliasi Mahasiswa</td>
				<td class="col-md-9">
				<?php foreach ($list_afiliasi_mhs as $lmhs)  {

					if (count($lmhs->nama_mhs) >=1 ) {
						echo "<i>$lmhs->nama_mhs <i> <br>";
					}else{
						echo "<i>$lmhs->nama_mhs <i>";
					}
				
				 } ?>
				</td>
			</tr>
			<tr>
				<td class="col-md-3">Kemitraan</td>
				<td class="col-md-9"></td>
			</tr>
			<?php 
			$no=1;
			foreach($list_mitra as $lm){?>
			<tr>
				<td class="col-md-3">&emsp;&emsp;Nama Mitra Program </td>
				<td class="col-md-9"><?=$lm->nama_mitra?></td>
			</tr>
			<tr>
				<td class="col-md-3">&emsp;&emsp;Wilayah</td>
				<td class="col-md-9"><?=$lm->propinsi?></td>
			</tr>
			<tr>
				<td class="col-md-3">&emsp;&emsp;Kabupaten</td>
				<td class="col-md-9"><?=$lm->kabupaten?></td>
			</tr>
			<tr>
				<td class="col-md-3">&emsp;&emsp;Jarak</td>
				<td class="col-md-9"><?=number_format($lm->jarak_lokasi)?> km</td>
			</tr>
			<?php }?>
			
		</table>
	</div>
	
</div>

<!-- Delete Modal -->
    <div class="modal fade" id="modalapprove" role="dialog">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Desk Evaluation</h4>
            </div>
            <div class="modal-body">
            	<form id="form_approve" method="POST">
                <select name="status" id="status" class="form-control">
                	<option value="">-- pilih --</option>
                	<option value="diterima" <?php if(($list->status == "diterima")){echo 'selected';}?>>Diterima</option>
                	<option value="ditolak" <?php if(($list->status == "ditolak")){echo 'selected';}?>>Ditolak</option>
                </select>
                <textarea id="komentar" name="komentar" class="form-control" placeholder="alasan ditolak"><?=@$list->komentar?></textarea>
                 <input type="text" style="display: none" name="id_proposal" id="id_proposal">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn_approve">Simpan</button>
                <div id="notif"></div>
              
            </div>
            
          </div>
        </div>
    </div>
<!--  End Delete Modal -->