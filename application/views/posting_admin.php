<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-list-alt" aria-hidden="true"></i> Daftar Posting
       	<div style="float:right;">
        <a data-target="#tambah_posting" id="tambah_mod_posting" href="#" data-toggle="modal" style="text-decoration:none;" class="btn btn-primary btn-xs"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Data</a>
        </div>
	</div>
	<div class="panel-body">
		<table id="daftar" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th width="col-md-1">No</th>
					<th width="col-md-3">Judul</th>
					<th width="col-md-2">Tgl Posting</th>
					<th width="col-md-5">Isi</th>
					<th width="col-md-1">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no=1;
				foreach($list as $l){
				?>
			<tr>
				<td><?=$no++?></td>
				<td><?=$l->judul_posting?></td>
				<td><?=$l->tgl_posting?></td>
				<td><?=$l->isi_posting?></td>
				<td>
				<a href="#" class="ubah_posting btn btn-warning btn-xs" id="<?=$l->id_posting?>" style="text-decoration:none;"><i class="fa fa-pencil-square fa-lg" aria-hidden="true"></i> Ubah</a> <br> <a href="#" class="hapus_posting btn btn-danger btn-xs" id="<?=$l->id_posting?>" data-togle="modal" style="text-decoration:none;"><i class="fa fa-trash fa-lg" aria-hidden="true"></i> Hapus</a> 
                    
				</td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Modal Tambah Posting -->
<div class="modal fade" id="tambah_posting" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Posting</h4>
        </div>
        <div class="modal-body">
          <div class="panel-body">
                <form id="form_posting" method="POST">
                 <br>
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th class="col-md-3">Judul Posting</th>
                        <td class="col-md-9"><input type="text" name="judul_posting" id="judul_posting" class="form-control" required></td>
                    </tr>
                    <tr>
                        <th class="col-md-3">Tanggal Posting</th>
                        <td class="col-md-9"><input type="date" name="tgl_posting" id="tgl_posting" class="form-control"></td>
                    </tr>
                    <tr>
                        <th class="col-md-3">Isi Posting</th>
                        <td class="col-md-9">
                        	<textarea id="isi_posting" name="isi_posting" class="form-control"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div id="notif_sukses"></div>
                        </td>
                        <td>
                            <div style="float:right;">
                                <input type="submit" name="simpan" value="Simpan" class=" btn btn-warning">
                                <input type="text" style="display: none" name="id_posting" id="id_posting"/>
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
<script type="text/javascript">
    
    CKEDITOR.replace('isi_posting');

</script>

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
                <button type="button" class="btn btn-danger btn_hapus_posting">Hapus</button>
                <div id="notif"></div>
                <input type="text" style="display: none" name="id_hapus" id="id_hapus">
            </div>
            
          </div>
        </div>
    </div>
<!--  End Delete Modal -->