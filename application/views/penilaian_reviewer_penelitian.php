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
					<th width="col-md-3">Ketua Peneliti</th>
					<th width="col-md-1">Scope</th>
					<th width="col-md-1">Status</th>
					<th width="col-md-1">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no=1;
				foreach($list as $l){
				$scope = $this->Model->ambil('id_kategori', $l->id_kategori, 'tb_kategori')->row();


				if ($l->didanai == 'didanai') {
					$dana = "<font color='#128F76'> Proposal Sudah Didanai </font>";
				}elseif($l->didanai == 'ditolak'){
					$dana = "<font color='#D62C1A'> Proposal Tidak Didanai </font>";
				}else{
					$dana = "<font color='#FFC145'> Sedang Diusulkan </font>";
				}

				?>
			<tr>
				<td><?=$no++?></td>
				<td><?=$l->judul_penelitian?></td>
				<td><?=$l->nama_ketua_peneliti?></td>
				<td><?=$scope->nama_kategori?></td>
				<td><?=$dana?> </td>
				<td>
					<a href="<?=base_url()?>reviewer/penilaian_penelitian/proposal_penelitian/<?=$l->id_proposal?>" class="btn btn-success btn-xs" id="" style=" text-decoration:none;"><i class="fa fa-eye fa-lg" aria-hidden="true"></i> Review</a>
				</td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>
