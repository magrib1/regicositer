<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-file-text" aria-hidden="true"></i> Usulan Proposal
       
	</div>
	<div class="panel-body">
        <div class="stepwizard_submission">
            <div class="stepwizard_submission-row setup-panel">
                <div class="stepwizard_submission-step col-xs-3"> 
                    <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                    <p><small>Data Usulan</small></p>
                </div>
                <div class="stepwizard_submission-step col-xs-3"> 
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled" >2</a>
                    <p><small>Anggota</small></p>
                </div>
            </div>
        </div>

        <div class="panel panel-primary setup-content" id="step-1">
            <div class="panel-heading">
                 <h3 class="panel-title">Deskripsi</h3>
            </div>
            <div class="panel-body">
        		<form id="form_usulan_proposal" method="POST">
                    <div class="form-group">
                        <label class="control-label">Judul *</label>
                        <input type="text" name="judul_penelitian" id="judul_penelitian" class="form-control" value="<?=@$list->judul_penelitian?>" placeholder="Masukkan judul karya ilmiah anda disini" required>
                        <input type="hidden" name="id_proposal" id="id_proposal" value="<?=$list->id_proposal?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Program Studi*</label>

                        <select name="nama_prodi" id="nama_prodi" class="form-control" required>
                            <option value="">---- pilih ----</option>
                            <?php foreach($list_prodi as $lpr){ ?>
                            <option value="<?=$lpr->kd_unit ?> - <?=$lpr->nama_unit ?>" <?php if($lpr->kd_unit == $list->kd_unit ){echo 'selected';}?> > <?=$lpr->kd_unit?> - <?=$lpr->nama_unit?></option>
                            <?php } ?>
                        </select>
                        *Bagi Program Studi yang tidak ada dalam daftar, harap menghubungi Bag.Kepegawaian untuk diinputkan Nama Prodi dan Sesprodi pada aplikasi SIMUK.
                    </div>
                    <label>Ketentuan</label>	
        			<div class="checkbox">	
        				<label><input type="checkbox" required <?php if (!empty($list->judul_penelitian)) {
                            echo 'checked';
                        }?>>&nbsp;Judul original dan belum pernah diusulkan sebelumnya.
                        </label>
        			</div>
        			<div class="checkbox">	
        				<label><input type="checkbox" required <?php if (!empty($list->judul_penelitian)) {
                            echo 'checked';
                        }?>>&nbsp;Konten original dan tidak ada unsur plagiat.
                        </label>
        			</div>
        			<br>
                    <div class="form-group">
                        <label class="control-label">Abstrak *</label>
                        <textarea id="abstrak_penelitian" name="abstrak_penelitian" class="form-control" placeholder="Masukkan abstrak anda disini" required><?=@$list->abstrak_penelitian?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Keyword</label>
                        <textarea id="keyword" name="keyword" class="form-control" placeholder="Pisahkan dengan ',' (koma)" required><?=@$list->keyword?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Scope</label>
                        <div class="radio">
                          <label>
                            <input name="id_kategori" id="Radios1" value="<?=@$list->id_kategori?>" type="radio" <?php if($list->id_kategori == '0'){echo "checked";} ?> >
                             Dasar/Fundamental
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input name="id_kategori" id="Radios2" value="" type="radio" <?php if($list->id_kategori != '0'){echo "checked";} ?>>
                             Unggulan
                          </label>
                        </div>
                        <select name="id_kategori" id="id_kategori" class="form-control" required>
                            <option value="">---- pilih ----</option>
                            <?php foreach($list_kategori as $lk){ ?>
                            <option value="<?=$lk->id_kategori ?>" <?php if($lk->id_kategori == $list->id_kategori ){echo 'selected';}?>><?=$lk->nama_kategori ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ketua Peneliti*</label>
                        <input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" <?php if(empty($list->ketua_peneliti)){?> value="<?=$this->session->userdata('id')?> - <?=$this->session->userdata('name')?>" <?php }else{?>value="<?=$list->ketua_peneliti?> - <?=$list->nama_ketua_peneliti?>" <?php }?> autocomplete="off" placeholder="contoh: ahmad lucky" readonly>
                            <ul class="dropdown-menu txtcountry" style="margin-left:30px;margin-right:0px; position: absolute; top: 690px;" role="menu" aria-labelledby="dropdownMenu"  id="DropdownCountry">
                            </ul>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tahun Diajukan/Lama Penelitian (dalam tahun) *</label>
                       <div class="row">
                            	<div class="col-md-10">
        	     				<input type="text" name="tahun_diajukan" id="tahun_diajukan" class="form-control" <?php if(empty($list->tahun_diajukan) || $list->tahun_diajukan == "0000-00-00"){?> value="<?=date("Y-m-d")?>" <?php }else{?> value="<?=$list->tahun_diajukan?>" <?php }?>readonly>
             					</div>
             					<div class="col-md-2">
             						<input type="text" name="lama_penelitian" id="lama_penelitian" class="form-control" value="<?=$list->lama_penelitian?>" placeholder="jumlah" required>
             					</div>
             				</div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Biaya Diusulkan (Rp.) *</label>
                        <input type="number" name="biaya_diusulkan" id="biaya_diusulkan" class="form-control" value="<?=$list->biaya_diusulkan?>" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Sumber Lain (Rp.) *</label>
                        <input type="number" name="sumber_lain" id="sumber_lain" class="form-control" value="<?=$list->sumber_lain?>" required>
                    </div>

                    	<div id="notif"></div>
                        <button class="btn btn-primary nextBtn pull-right usulan" type="button">Next</button>
                </form>
            </div>
        </div>
        <div class="panel panel-primary setup-content" id="step-2">
            <div class="panel-heading">
                 <h3 class="panel-title">Anggota</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <form id="form_afiliasi_dosen">
                    <label class="control-label">Anggota Dosen</label>
                    <?php 
                    $cek = $this->Model->ambil('id_proposal',$list->id_proposal,'tb_afiliasi_dosen')->num_rows();
                    //var_dump($cek);
                    ?>
                    <div class="col-md-11">     
                        <input type="text" name="afiliasi_dosen" id="afiliasi_dosen" class="form-control" autocomplete="off" placeholder="contoh: ahmad lucky" required>
                            <ul class="dropdown-menu txtcountry2" style="margin-left:20px;margin-right:0px; position: absolute; top: 40px;" role="menu" aria-labelledby="dropdownMenu"  id="DropdownCountry2">
                            </ul>
                        <input type="hidden" name="id_proposal" id="id_proposal" value="<?=$list->id_proposal?>">
                    </div>
                    <div class="col-md-1">
                    <?php if($cek < 3){?> 
                        <button class="btn btn-primary afiliasi_dosen"><i class="fa fa-plus-square" aria-hidden="true"></i></button> 
                    <?php }?>
                    </div> 
                    <div id="notif"></div>
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th class="col-md-10"></th>
                                <th class="col-md-2"></th>
                            </tr>
                        </thead>
                       
                        <?php foreach ($list_afiliasi_dosen as $lj) {
                         ?>
                        <tbody>
                            <td><?=$lj->nama_anggota?><input type="text" style="display: none" name="id_hapus" id="id_hapus" value="<?=$lj->id_afiliasi_dosen?>"></td>
                            <td><a href="#" class="hapus_afiliasi_dosen" id="<?=$lj->id_afiliasi_dosen?>" data-togle="modal" style="color:#DAA520; text-decoration:none;"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a> </td>
                        </tbody>
                        <?php } ?>
                    </table>
                    </form>
                </div>
            </div>

             <div class="panel-body">
                <div class="form-group">
                    <form id="form_afiliasi_mahasiswa">
                    <label class="control-label">Anggota Mahasiswa</label>
                    <div class="col-md-11">     
                        <input type="text" name="afiliasi_mhs" id="afiliasi_mhs" class="form-control" autocomplete="off" placeholder="contoh: Sari" required>
                            <ul class="dropdown-menu txtcountry3" style="margin-left:20px;margin-right:0px; position: absolute; top: 40px;" role="menu" aria-labelledby="dropdownMenu"  id="DropdownCountry3">
                            </ul>
                        <input type="hidden" name="id_proposal" id="id_proposal" value="<?=$list->id_proposal?>">
                    </div>
                    <div class="col-md-1"> 
                        <button class="btn btn-primary afiliasi_mahasiswa"><i class="fa fa-plus-square" aria-hidden="true"></i></button> 
                    </div> 
                    <div id="notif"></div>
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th class="col-md-10"></th>
                                <th class="col-md-2"></th>
                            </tr>
                        </thead>
                       
                        <?php foreach ($list_afiliasi_mhs as $lj) {
                         ?>
                        <tbody>
                            <td><?=$lj->nama_mhs?><input type="text" style="display: none" name="id_hapus" id="id_hapus2" value="<?=$lj->id_afiliasi_mhs?>"></td>
                            <td><a href="#" class="hapus_afiliasi_mahasiswa" id="<?=$lj->id_afiliasi_mhs?>" data-togle="modal" style="color:#DAA520; text-decoration:none;"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a> </td>
                        </tbody>
                        <?php } ?>
                    </table>
                    </form>
                    <a class="btn btn-success pull-right" href="#modalfinish" data-toggle="modal">Submit</a>
                </div>
            </div>

            
        </div>

	</div>

</div>

<!-- Selesai Modal --> 
    <div class="modal fade" id="modalfinish" role="dialog">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Selesai Mengisi</h4>
            </div>
            <div class="modal-body">
                Anda yakin telah mengisi seluruh data ? <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Tidak</button> 
                <button type="button" class="btn btn-success finish">Selesai</button>
                <div id="notif"></div>
                <input type="text" style="display: none" name="id_hapus" id="id_hapus">
            </div>
            
          </div>
        </div>
    </div>
<!-- End Selesai Modal -->