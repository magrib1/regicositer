<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-list-alt" aria-hidden="true"></i> Daftar Nilai Reviewer
       	<div style="float:right;">
        <a onClick="javascript: history.go(-1)" id="tambah_mod_kategori" href="#" data-toggle="modal" style="text-decoration:none;" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i>Kembali</a>
        </div>
	</div>
	<div class="panel-body">
		<table id="daftar" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th width="col-md-1">No</th>
					<th width="col-md-3">Reviewer</th>
					<!-- <th width="col-md-3">Total Nilai</th> -->
					<th width="col-md-5">Komentar</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no=1;
				$n=1;
				foreach($list as $l){
				$jml = $this->Model->jumlah('nilai','tb_nilai_review','id_review_proposal',$l->id_review_proposal )->row();
				?>
			<tr>
				<td><?=$no++?></td>
				<td>Reviewer <?=$n++?></td>
				<!-- <td><?=$jml->nilai?></td> -->
				<td><?=$l->komentar_reviewer?></td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
		<!-- <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" arial-label="close">&times;</a> Mohon Maaf, untuk sementara nilai tidak dapat ditampilkan !</div> -->
	</div>
</div>