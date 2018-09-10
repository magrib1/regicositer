<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-list-alt" aria-hidden="true"></i> Daftar Proposal

	</div>
	<div class="panel-body">
		<table id="daftar" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th width="col-md-1">No</th>
					<th width="col-md-5">Judul Penelitian</th>
          <th width="col-md-5">Ketua Peneliti</th>
          <th width="col-md-1">Jenis</th>
          <th width="col-md-1">Status</th>
					
				</tr>
			</thead>
			<tbody>
				<?php
				$no=1;
				foreach($list as $l){
					if ($l->status == 'diterima') {
			            $status = 'Diterima Desk Evaluation';
			          }elseif($l->status == 'ditolak'){
			            $status = 'Ditolak Desk Evaluation';
			          }else{
			            $status = 'Diusulkan';
			          }
				?>
			<tr>
				<td><?=$no++?></td>
				<td><?=$l->judul_penelitian?></td>
		    <td><?=$l->nama_ketua_peneliti?></td>
		    <td><?=$l->jenis?></td>
        <td><?=$status?></td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>