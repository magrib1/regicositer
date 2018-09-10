<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-list-alt" aria-hidden="true"></i> Rekap Nilai Proposal
       	<!-- <div style="float:right;">
        <a data-target="#tambah_kategori" id="tambah_mod_kategori" href="#" data-toggle="modal" style="text-decoration:none;" class="btn btn-primary btn-xs"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Data</a>
        </div> -->
	</div>

	<div class="panel-body">
		<form id="form_rekap_nilai" action="<?=base_url()?>admin/rekap_nilai/nilai_excel" method="POST">
			<table class="table table-striped table-bordered table-hover">
				<tr>
                        <th class="col-md-3">Jenis</th>
                        <td class="col-md-9">
                        	<select name="jenis" id="jenis" class="form-control">
			                	<option value="">-- pilih --</option>
			                	<option value="semua" >Semua</option>
			                	<option value="penelitian" >Penelitian</option>
			                	<option value="pengabdian" >Pengabdian</option>
			                </select>
                        </td>
                    </tr>

                    <tr>
                        <th class="col-md-3">Tahun</th>
                        <td class="col-md-9">
                        	<select name="tahun" id="tahun" class="form-control">
	                        	<option value="">---- pilih ----</option>
	                            <?php foreach($list as $lk){ ?>
	                            <option value="<?=$lk->tahun ?>" ><?=$lk->tahun ?></option>
	                            <?php } ?>
                        	</select>
                        </td>
                    </tr>
            </table>
            <div style="float:right;">
			<input type="submit" name="export_proposal" value="Export Excel" class="form-control btn btn-info">
			</div>
		</form>
	</div>

</div>