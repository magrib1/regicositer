<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-list-alt" aria-hidden="true"></i> Evaluasi Dokumen Proposal Pengabdian
		<div style="float:right;">
        <a href="<?=base_url()?>reviewer/penilaian_pengabdian" style="text-decoration:none;"  class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
        
    </div>
       
	</div>
	<div class="panel-body">
		<?php 
		$scope = $this->Model->ambil('id_kategori',$list->id_kategori,'tb_kategori')->row(); 
		$data_dosen = $this->M_simuk->ambil('id_pegawai',$list->ketua_peneliti, 'tb_pegawai')->row();
		$unit = $this->M_simuk->ambil('kd_unit',$data_dosen->kd_unit, 'tb_unit')->row();
		$jml_dosen = $this->Model->ambil('id_proposal',$list->id_proposal,'tb_afiliasi_dosen')->num_rows();
		$jml_mhs = $this->Model->ambil('id_proposal',$list->id_proposal,'tb_afiliasi_mhs')->num_rows();
		?>
		<table class="table table-striped table-hover">
			<?php if(!empty($file->nama_file)) {?>
               <object width="100%" height="800" data="<?=base_url()?>assets/file_upload/<?=$file->nama_file?>" type="application/pdf"></object> 
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
				<td class="col-md-3">Scope</td>
				<td class="col-md-9"><?=@$scope->nama_kategori?></td>
			</tr>
			<tr>
				<td class="col-md-3">&emsp;Ketua Peneliti</td>
				<td class="col-md-9"><?=@$list->nama_ketua_peneliti?></td>
			</tr>
			<tr>
				<td class="col-md-3">&emsp;Program Studi</td>
				<td class="col-md-9"><?=@$unit->nama_unit?></td>
			</tr>
			<tr>
				<td class="col-md-3">&emsp;NIDN</td>
				<td class="col-md-9"><?=@$data_dosen->nidn?></td>
			</tr>
			
			<tr>
				<td class="col-md-3">Anggota Peneliti</td>
				<td class="col-md-9"><?=$jml_dosen?> dosen, <?=$jml_mhs?> mahasiswa</td>
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
				<th class="col-md-3">Total</th>
				<th class="col-md-9">Rp. <?=@number_format($list->biaya_diusulkan+$list->sumber_lain)?></th>
			</tr>
		</table>
		<hr>
		<form id="form_penilaian" method="POST">
		<table class="table table-striped table-hover table-bordered">
		<tr>
			<th class="col-md-3">Biaya yang direkomendasikan</th>
			<th class="col-md-9" colspan="4">
				<?php if($list->lock_nilai == '0'){?>
				<input type="text" name="biaya_rekomendasi" id="biaya_rekomendasi" class="form-control" value="<?=@$list->biaya_rekomendasi?>">
				<?php }else{?>
					<?=number_format($list->biaya_rekomendasi)?>
				<?php }?>
			<input type="hidden" name="id_review_proposal" id="id_review_proposal" value="<?=@$list->id_review_proposal?>">
			</th>				
		</tr>
		<tr>
			<th class="col-md-3">Komentar</th>
			<th class="col-md-9">
				<?php if($list->lock_nilai == '0'){?>
				<textarea id="komentar" name="komentar" class="form-control"><?=@$list->komentar_reviewer?></textarea>
				<?php }else{?>
					<?=@($list->komentar_reviewer)?>
				<?php }?>
			</th>
		</tr>
		</table>	
		<table class="table table-striped table-hover table-bordered">			
			<tr>
				<th class="col-md-1">No</th>
				<th class="col-md-8">Kriteria Penilaian</th>	
				<th class="col-md-1">Bobot</th>
				<th class="col-md-1">Skor</th>
				<th class="col-md-1">Nilai</th>
			</tr>
			<?php 
			$s1 = $this->Model->ambil_banyak_kondisi('tb_nilai_review', array('id_review_proposal' => $list->id_review_proposal, 'nama_penilaian' => 's1peng'))->row();
			$s2 = $this->Model->ambil_banyak_kondisi('tb_nilai_review', array('id_review_proposal' => $list->id_review_proposal, 'nama_penilaian' => 's2peng'))->row();
			$s3 = $this->Model->ambil_banyak_kondisi('tb_nilai_review', array('id_review_proposal' => $list->id_review_proposal, 'nama_penilaian' => 's3peng'))->row();
			$s4 = $this->Model->ambil_banyak_kondisi('tb_nilai_review', array('id_review_proposal' => $list->id_review_proposal, 'nama_penilaian' => 's4peng'))->row();
			$s5 = $this->Model->ambil_banyak_kondisi('tb_nilai_review', array('id_review_proposal' => $list->id_review_proposal, 'nama_penilaian' => 's5peng'))->row();
			$s6 = $this->Model->ambil_banyak_kondisi('tb_nilai_review', array('id_review_proposal' => $list->id_review_proposal, 'nama_penilaian' => 's6peng'))->row();
			$jml = $this->Model->jumlah('nilai','tb_nilai_review','id_review_proposal',$list->id_review_proposal )->row();

			?>
			<tr>
				<td class="col-md-1">1</td>
				<td class="col-md-6">Analisis situasi (kondisi mitra saat ini, persoalan umum yang dihadapi mitra)</td>	
				<td class="col-md-1">20</td>
				<td class="col-md-1">
					<?php if($list->lock_nilai == '0'){?>
					<input type="text" name="s1" id="s1" class="form-control" value="<?=@$s1->skor?>" required>
					<?php }else{?>
					<?=@($s1->skor)?>
					<?php }?>
				</td>						
				<td class="col-md-1"><?=@$s1->nilai?></td>
			</tr>
			<tr>
				<td class="col-md-1">2</td>
				<td class="col-md-8">Permasalahan prioritas mitra dan solusi yang dutawarkan (kecocokan permasalahan, solusi dan kompetensi tim)</td>	
				<td class="col-md-1">15</td>
				<td class="col-md-1">
					<?php if($list->lock_nilai == '0'){?>
					<input type="text" name="s2" id="s2" class="form-control" value="<?=@$s2->skor?>" required>
					<?php }else{?>
					<?=@($s2->skor)?>
					<?php }?>
				</td>
				<td class="col-md-1"><?=@$s2->nilai?></td>
			</tr>
			<tr>
				<td class="col-md-1">3</td>
				<td class="col-md-8">Target Luaran (jenis luaran dan spesifikasinya sesuai kegiatan yang diusulkan)</td>	
				<td class="col-md-1">15</td>
				<td class="col-md-1">
					<?php if($list->lock_nilai == '0'){?>
					<input type="text" name="s3" id="s3" class="form-control" value="<?=@$s3->skor?>" required>
					<?php }else{?>
					<?=@($s3->skor)?>
					<?php }?>
				</td>
				<td class="col-md-1"><?=@$s3->nilai?></td>
			</tr>
			<tr>
				<td class="col-md-1">4</td>
				<td class="col-md-8">Ketepatan Metode pendekatan untuk mengatasi permasalahan, rencana kegiatan, kontribusi partisipasi mitra</td>	
				<td class="col-md-1">20</td>
				<td class="col-md-1">
					<?php if($list->lock_nilai == '0'){?>
					<input type="text" name="s4" id="s4" class="form-control" value="<?=@$s4->skor?>" required>
					<?php }else{?>
					<?=@($s4->skor)?>
					<?php }?>
				</td>
				<td class="col-md-1"><?=@$s4->nilai?></td>
			</tr>
			<tr>
				<td class="col-md-1">5</td>
				<td class="col-md-8">Kelayakan Pengabdian kepada Masyarakat : kualifikasi tim pelaksana, relevansi keahlian tim, sinergisme tim, pengalaman kemasyarakatan, organisasi tim, jadwal kegiatan dan kelengkapan lampiran</td>	
				<td class="col-md-1">10</td>
				<td class="col-md-1">
					<?php if($list->lock_nilai == '0'){?>
					<input type="text" name="s5" id="s5" class="form-control" value="<?=@$s5->skor?>" required>
					<?php }else{?>
					<?=@($s5->skor)?>
					<?php }?>
				</td>
				<td class="col-md-1"><?=@$s5->nilai?></td>
			</tr>
			<tr>
				<td class="col-md-1">6</td>
				<td class="col-md-8">Biaya pekerjaan kelayakan usulan biaya (bahan habis, peralatan, perjalanan dan lainnya)</td>	
				<td class="col-md-1">20</td>
				<td class="col-md-1">
					<?php if($list->lock_nilai == '0'){?>
					<input type="text" name="s6" id="s6" class="form-control" value="<?=@$s6->skor?>" required>
					<?php }else{?>
					<?=@($s6->skor)?>
					<?php }?>
				</td>
				<td class="col-md-1"><?=@$s6->nilai?></td>
			</tr>
			<tr>
				
				<th class="col-md-8" colspan="2"><center>Jumlah</center></th>	
				<td class="col-md-1">100</td>
				<td class="col-md-1"></td>
				<td class="col-md-1"><?=$jml->nilai?></td>
			</tr>
			<tr>
				<td colspan="5">
					<div style="min-height:100px; background: #F56954; color: #fff; border-radius:2px; border-bottom: solid 24px #DC5E4B">
					Keterangan :<br><img src="<?=base_url()?>./assets/ll.jpeg" class="img-responsive" width="100%"> <br> Skor : 1, 2, 3, 4, 5, 6, 7 (1 = buruk, 2 = sangat kurang, 3 = kurang, 5 = cukup, 6 = baik, 7 = sangat baik). <br> Nilai = bobot x skor.<br>
					
						Tombol <b>Simpan</b> untuk menyimpan skor sementara dan masih bisa diedit, tombol <b>Lock</b> untuk menyimpan nilai final dan tidak dapat diedit lagi.
					</div>
				</td>
			</tr>
			<?php if($list->lock_nilai == '0'){?>
			<tr>          
                <td colspan="5">
                  <div id="notif"></div>
                    <div style="float:right;">
                        <input type="submit" name="simpan" value="Simpan" class=" btn btn-info btn_simpan_nilai">
                        <input type="submit" name="lock" value="Lock" id="<?=$list->id_review_proposal?>" class=" btn btn-danger btn_lock_nilai">
                    </div>
                </td>
            </tr>
            <?php }?>
		</table>

		</form>
	</div>
	
</div>

<!-- Lock Modal -->
    <div class="modal fade" id="modalLock" role="dialog">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Lock Nilai</h4>
            </div>
            <div class="modal-body">
                Nilai yang sudah di lock tidak bisa dirubah/edit lagi ! <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Tidak</button> 
                <button type="button" class="btn btn-danger btn_lock">Lock</button>
                <div id="notif"></div>
                <input type="text" style="display: none" name="id_rev" id="id_rev">
            </div>
            
          </div>
        </div>
    </div>
<!--  End Delete Modal -->