<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-list-alt" aria-hidden="true"></i> Daftar Usulan Proposal Penelitian
       
	</div>
	<div class="panel-body">
		<table id="daftar" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th width="col-md-1">No</th>
					<th width="col-md-5">Judul</th>
					<th width="col-md-3">Ketua Peneliti / Reviewer</th>
					<th width="col-md-1">Status</th>
					<th width="col-md-1">File</th>
					<th width="col-md-1">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no=1;
				foreach($list as $l){
				$file = $this->Model->ambil('id_proposal',$l->id_proposal,'tb_file_upload')->num_rows();
				$reviewer = $this->Model->list_join_where_banyak('tb_review_proposal','tb_reviewer','tb_review_proposal.id_reviewer=tb_reviewer.id_reviewer',array('id_proposal' => $l->id_proposal) )->result();

				if ($file != 0) {
					$cek = "Sudah Upload"; 
				}else{
					$cek = "Belum Upload";
				}

				if ($l->didanai == 'didanai') {
					$dana = "Proposal Didanai";
				}elseif($l->didanai == 'ditolak'){
					$dana = "Proposal Tidak Didanai";
				}else{
					$dana = "";
				}
				?>
			<tr>
				<td><?=$no++?></td>
				<td><?=$l->judul_penelitian?></td>
				<td><?=$l->nama_ketua_peneliti?><br><hr>
					<?php foreach ($reviewer as $rf)  {

					if (count($rf->nama_reviewer) >=1 ) {
						echo "<i>$rf->nama_reviewer <i> <br>";
					}else{
						echo "<i>$rf->nama_reviewer <i>";
					}
				
				 } ?>
				</td>
				
				<td><?=$l->status?> <hr> <?=$dana?> </td>
				<td><?=$cek?></td>
				<td>
					<a href="<?=base_url()?>admin/penelitian/detail/<?=$l->id_proposal?>" class="btn btn-success btn-xs" id="" style=" text-decoration:none;"><i class="fa fa-eye fa-lg" aria-hidden="true"></i> Detail</a> <!-- <br> <a href="#" class="approve btn btn-warning btn-xs" id="<?=$l->id_proposal?>" data-togle="modal" style=" text-decoration:none;"><i class="fa fa-check fa-lg" aria-hidden="true"></i> Evaluation</a> --> <br>
					<?php if($l->status =='diterima'){?>
					<a href="<?=base_url()?>admin/penelitian/rev/<?=$l->id_proposal?>" class="btn btn-info btn-xs" style=" text-decoration:none;"><i class="fa fa-user-plus fa-lg" aria-hidden="true"></i> Reviewer</a> <br>
					<a href="#modalDana" id="<?=$l->id_proposal?>" data-togle="modal" class="btn btn-warning btn-xs dana" style=" text-decoration:none;"><i class="fa fa-money fa-lg" aria-hidden="true"></i> Dana</a>
					<?php }?>
					<?php if($l->status =='diusulkan'){?>
					 <a href="#" class="hapus_usulan btn btn-danger btn-xs" id="<?=$l->id_proposal?>" data-togle="modal" style="text-decoration:none;"><i class="fa fa-trash fa-lg" aria-hidden="true"></i> Hapus</a> 
					<?php }?>
                    
				</td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Delete Modal -->
    <div class="modal fade" id="modalapprove" role="dialog">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Task Evaluation</h4>
            </div>
            <div class="modal-body">
            	<form id="form_approve" method="POST">
                <select name="status" id="status" class="form-control">
                	<option value="">-- pilih --</option>
                	<option value="diterima" <?php if(($l->status == "diterima")){echo 'selected';}?>>Diterima</option>
                	<option value="ditolak" <?php if(($l->status == "ditolak")){echo 'selected';}?>>Ditolak</option>
                </select><br>
                <textarea id="komentar" name="komentar" class="form-control" placeholder="alasan ditolak"><?=@$l->komentar?></textarea>
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

<!-- Delete Modal -->
    <div class="modal fade" id="modalDana" role="dialog">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Pendanaan</h4>
            </div>
            <div class="modal-body">
            	<form id="form_dana" method="POST">
                <select name="didanai" id="didanai" class="form-control">
                	<option value="">-- pilih --</option>
                	<option value="didanai" <?php if(($l->didanai == "didanai")){echo 'selected';}?>>Didanai</option>
                	<option value="ditolak" <?php if(($l->didanai == "ditolak")){echo 'selected';}?>>Ditolak</option>
                </select><br>
                 <input type="text" style="display: none" name="id_proposal2" id="id_proposal2">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn_dana">Simpan</button>
                <div id="notif"></div>
              
            </div>
            
          </div>
        </div>
    </div>
<!--  End Delete Modal -->