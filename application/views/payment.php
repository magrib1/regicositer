<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-list-alt" aria-hidden="true"></i> Daftar Payment
       	<div style="float:right;">
        <a data-target="#tambah_payment" id="tambah_mod_payment" href="#" data-toggle="modal" style="text-decoration:none;" class="btn btn-primary btn-xs"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Data</a>
        </div>
	</div>
	<div class="panel-body">
        <div class="table-responsive"> 
		<table id="daftar" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th width="col-md-1">No</th>
					<th width="col-md-5">Author</th>
                    <th width="col-md-5">E-mail</th>
                    <th width="col-md-5">File</th>
                    <th width="col-md-5">Waktu Upload</th>
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
                <td><?=$l->email?></td>
                <td> <?php if(empty($l->payment_upload)){ echo "-"; }else{ ?> <img src="<?=base_url()?>assets/file_upload/<?=$l->payment_upload?>" width="300px" class="img-thumbnail" > <?php } ?> </td>
                <td><?=$l->date_create?></td>
				<td>
				<a href="#" class="ubah_payment btn btn-warning btn-xs" id="<?=$l->id_payment?>" style="text-decoration:none;"><i class="fa fa-pencil-square fa-lg" aria-hidden="true"></i> Ubah</a> <br> <a href="#" class="hapus_payment btn btn-danger btn-xs" id="<?=$l->id_payment?>" data-togle="modal" style="text-decoration:none;"><i class="fa fa-trash fa-lg" aria-hidden="true"></i> Hapus</a> 
                    
				</td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
        </div>
	</div>
</div>

<!-- Modal Tambah payment -->
<div class="modal fade" id="tambah_payment" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Payment</h4>
        </div>
        <div class="modal-body">
          <div class="panel-body">
                <form id="form_payment" method="POST" >
                 <br>
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th class="col-md-3">Author</th>
                        <td class="col-md-9"><input type="text" name="author" id="author" class="form-control" required></td>
                    </tr>
                   
                    <tr>
                        <th class="col-md-3">E-Mail</th>
                        <td class="col-md-9">
                        	<input type="email" id="email" name="email" class="form-control">
                        </td>
                    </tr>
                    
                    <tr>
                        <th class="col-md-3">File</th>
                        <td class="col-md-9">
                            <input type="file" id="payment_upload" name="payment_upload" class="form-control">
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
                                <input type="text" style="display: none" name="id_payment" id="id_payment"/>
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
                <button type="button" class="btn btn-danger btn_hapus_payment">Hapus</button>
                <div id="notif"></div>
                <input type="text" style="display: none" name="id_hapus" id="id_hapus">
            </div>
            
          </div>
        </div>
    </div>
<!--  End Delete Modal -->