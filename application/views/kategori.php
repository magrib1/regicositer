<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-list-alt" aria-hidden="true"></i> Daftar Kategori
       	<div style="float:right;">
        <a data-target="#tambah_kategori" id="tambah_mod_kategori" href="#" data-toggle="modal" style="text-decoration:none;" class="btn btn-primary btn-xs"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Data</a>
        </div>
	</div>
	<div class="panel-body">
		<table id="daftar" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th width="col-md-1">No</th>
					<th width="col-md-10">Kategori</th>
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
				<td><?=$l->nama_kategori?></td>
				<td>
				<a href="#" class="ubah_kategori btn btn-warning btn-xs" id="<?=$l->id_kategori?>" style="text-decoration:none;"><i class="fa fa-pencil-square fa-lg" aria-hidden="true"></i> Ubah</a> <br> <a href="#" class="hapus_kategori btn btn-danger btn-xs" id="<?=$l->id_kategori?>" data-togle="modal" style="text-decoration:none;"><i class="fa fa-trash fa-lg" aria-hidden="true"></i> Hapus</a> 
                    
				</td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Modal Tambah kategori -->
<div class="modal fade" id="tambah_kategori" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Kategori</h4>
        </div>
        <div class="modal-body">
          <div class="panel-body">
                <form id="form_kategori" method="POST">
                 <br>
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th class="col-md-3">Nama Kategori</th>
                        <td class="col-md-9"><input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required></td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div id="notif_sukses"></div>
                        </td>
                        <td>
                            <div style="float:right;">
                                <input type="submit" name="simpan" value="Simpan" class=" btn btn-warning">
                                <input type="text" style="display: none" name="id_kategori" id="id_kategori"/>
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