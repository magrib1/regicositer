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
					<th width="col-md-5">Author</th>
					<th width="col-md-5">Title</th>
                    <th width="col-md-5">E-mail</th>
                    <th width="col-md-5">Sub Theme</th>
                    <th width="col-md-5">File</th>
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
				<td><?=$l->author?></td>
                <td><?=$l->title?></td>
                <td><?=$l->email?></td>
				<td><?=$l->name_sub_theme?></td>
                <td> <?php if(empty($l->paper_upload)){ echo "-"; }else{ ?> <a href="<?=base_url()?>assets/file_upload/<?=$l->paper_upload?>" target="_blank"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> </a> <?php } ?> </td>
				<td>
				<a href="#" class="ubah_fullpaper btn btn-warning btn-xs" id="<?=$l->id_fullpaper?>" style="text-decoration:none;"><i class="fa fa-pencil-square fa-lg" aria-hidden="true"></i> Ubah</a> <br> <a href="#" class="hapus_fullpaper btn btn-danger btn-xs" id="<?=$l->id_fullpaper?>" data-togle="modal" style="text-decoration:none;"><i class="fa fa-trash fa-lg" aria-hidden="true"></i> Hapus</a> 
                    
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
          <h4 class="modal-title">Tambah Fullpaper</h4>
        </div>
        <div class="modal-body">
          <div class="panel-body">
                <form id="form_fullpaper" method="POST" >
                 <br>
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th class="col-md-3">Author</th>
                        <td class="col-md-9"><input type="text" name="author" id="author" class="form-control" required></td>
                    </tr>
                    <tr>
                        <th class="col-md-3">Title</th>
                        <td class="col-md-9"><input type="text" name="title" id="title" class="form-control"></td>
                    </tr>
                    <tr>
                        <th class="col-md-3">E-Mail</th>
                        <td class="col-md-9">
                        	<input type="mail" id="email" name="email" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <th class="col-md-3">Sub-Theme</th>
                        <td class="col-md-9">
                            <select name="id_sub_theme" id="id_sub_theme" class="form-control">
                                <option value="">--- Pilih ---</option>
                                <?php foreach($list_sub as $ll){ ?>
                                <option value="<?=$ll->id_sub_theme ?>" ><?=$ll->name_sub_theme ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="col-md-3">File</th>
                        <td class="col-md-9">
                            <input type="file" id="paper_upload" name="paper_upload" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <th class="col-md-3">Status</th>
                        <td class="col-md-9">
                            <select name="approve" id="approve" class="form-control">
                                <option value="">--- Pilih ---</option>
                                <option value="Approve">Approve</option>
                                <option value="Not-Approve">Not-Approve</option>
                            </select>
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