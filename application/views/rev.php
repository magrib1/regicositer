<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-list-alt" aria-hidden="true"></i> Daftar Reviewer Proposal (<?=$list->judul_penelitian?>)
       	<div style="float:right;">
       		<a onClick="javascript: history.go(-1)" style="text-decoration:none;"  class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Kembali</a>
        <a data-target="#tambah_reviewer" id="tambah_mod_reviewer" href="#" data-toggle="modal" style="text-decoration:none;" class="btn btn-primary btn-xs"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Data</a>
        </div>
	</div>
	<div class="panel-body">
		<table id="daftar" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th width="col-md-1">No</th>
					<th width="col-md-5">Nama Reviewer</th>
					<th width="col-md-1">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no=1;
				foreach($list_reviewer_proposal as $l){
				?>
			<tr>
				<td><?=$no++?></td>
				<td><?=$l->nama_reviewer?></td>
				<td>
					<a href="#" class="hapus_reviewer btn btn-danger btn-xs" id="<?=$l->id_review_proposal?>" data-togle="modal" style="text-decoration:none;"><i class="fa fa-trash fa-lg" aria-hidden="true"></i> Hapus</a> 
				</td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Modal Add -->
    <div class="modal fade" id="tambah_reviewer" role="dialog">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Tambah Reviewer</h4>
            </div>
            <div class="modal-body">
            	<form id="form_reviewer" method="POST">
            	<br>
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th class="col-md-3">Nama Reviewer</th>
                        <td class="col-md-9">
                        	<select name="id_reviewer" id="id_reviewer" class="form-control" required>
			                	<option value="">-- pilih --</option>
			                	<?php foreach($list_reviewer as $lv){ ?>
			                                <option value="<?=$lv->id_reviewer ?>"><?=$lv->nama_reviewer ?></option>
			                                <?php } ?>
			                </select>
			                <input type="text" style="display: none" name="id_proposal" id="id_proposal" value="<?=$list->id_proposal?>">
			                <input type="text" style="display: none" name="id_file_upload" id="id_file_upload" value="<?=$file->id_file_upload?>">
			                <input type="text" style="display: none" name="status" id="status" value="<?=$file->status?>">
                        </td>
                    </tr>
                    
                </table>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn_reviewer">Simpan</button>
                <div id="notif"></div>
              
            </div>
            
          </div>
        </div>
    </div>
<!--  End Modal Add -->

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
                <button type="button" class="btn btn-danger btn_hapus_kategori">Hapus</button>
                <div id="notif"></div>
                <input type="text" style="display: none" name="id_hapus" id="id_hapus">
            </div>
            
          </div>
        </div>
    </div>
<!--  End Delete Modal -->