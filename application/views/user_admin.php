<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-list-alt" aria-hidden="true"></i> Daftar Fullpaper
       	<div style="float:right;">
        <a data-target="#tambah_fullpaper" id="tambah_mod_fullpaper" href="#" data-toggle="modal" style="text-decoration:none;" class="btn btn-primary btn-xs"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Data</a>
        </div>
	</div>
	<div class="panel-body">
        <div class="table-responsive">
		<table id="daftar" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th width="col-md-1">No</th>
					<th width="col-md-5">Username</th>
					<th width="col-md-5">Level</th>
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
				<td><?=$l->username?></td>
                <td><?=$l->level?></td>
				<td>
				<a href="#" class="ubah_fullpaper btn btn-warning btn-xs" id="<?=$l->id_login?>" style="text-decoration:none;"><i class="fa fa-pencil-square fa-lg" aria-hidden="true"></i> Ubah</a> <br> <a href="#" class="hapus_fullpaper btn btn-danger btn-xs" id="<?=$l->id_login?>" data-togle="modal" style="text-decoration:none;"><i class="fa fa-trash fa-lg" aria-hidden="true"></i> Hapus</a> 
                    
				</td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
        </div>
	</div>
</div>

<!-- Modal Tambah fullpaper -->
<div class="modal fade" id="tambah_fullpaper" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah fullpaper</h4>
        </div>
        <div class="modal-body">
          <div class="panel-body">
                <form id="form_fullpaper" method="POST">
                 <br>
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th class="col-md-3">Nama fullpaper</th>
                        <td class="col-md-9"><input type="text" name="nama_fullpaper" id="nama_fullpaper" class="form-control" required></td>
                    </tr>
                    <tr>
                        <th class="col-md-3">No Hp</th>
                        <td class="col-md-9"><input type="text" name="no_hp" id="no_hp" class="form-control"></td>
                    </tr>
                    <tr>
                        <th class="col-md-3">e_mail</th>
                        <td class="col-md-9">
                        	<input type="text" id="e_mail" name="e_mail" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <th class="col-md-3">Username</th>
                        <td class="col-md-9">
                            <input type="text" id="username" name="username" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <th class="col-md-3">Password</th>
                        <td class="col-md-9">
                            <input type="password" id="password" name="password" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div id="notif_sukses"></div>
                        </td>
                        <td>
                            <div style="float:right;">
                                <input type="submit" name="simpan" value="Simpan" class=" btn btn-warning">
                                <input type="text" style="display: none" name="id_fullpaper" id="id_fullpaper"/>
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
                <button type="button" class="btn btn-danger btn_hapus_fullpaper">Hapus</button>
                <div id="notif"></div>
                <input type="text" style="display: none" name="id_hapus" id="id_hapus">
            </div>
            
          </div>
        </div>
    </div>
<!--  End Delete Modal -->