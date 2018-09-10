
<html>
  <head>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/bootstrap/theme/bootstrap.min.css">
    <title>Halaman Pengesahan</title>
   <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <style type="text/css" media="print">

        @page 
        {
            size: auto;   /* auto is the current printer page size */
            margin: 1mm;  /* this affects the margin in the printer settings */
            font-family: "Times New Roman", Times, serif;
            font-size: 12px;
            size: A4;
            margin: 0mm;
        }

        body 
        {
            background-color:#FFFFFF; 
            /*border: solid 1px black ;*/
            margin: 1px;  /* the margin on the content before printing */
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            margin: 3mm 3mm 3mm 3mm;
       }
       @media print {
        .pagebreak { page-break-before: always; font-family: "Times New Roman", Times, serif;
            font-size: 12px; size: A4; margin: 3mm 3mm 3mm 3mm; }

    }
    </style>


    <script type="text/javascript">
        $( document ).ready(function() {
           window.print()
        });
    </script>
    <?php include './assets/act.php'; ?>     
  </head>
  <body>
    <font size="12" face="Times New Roman">
        <br>
    <center>
        <h4> HALAMAN PENGESAHAN <br> PENGABDIAN KEPADA MASYARAKAT HIBAH MANDIRI </h4> <br>

        <table>
            <tr>
                <td class="col-md-3">1. Judul PkM</td>
                <th class="col-md-9">: <?=@$list->judul_penelitian?></th>
            </tr>
            <tr>
                <td class="col-md-3">2. Ketua Tim</td>
                <td class="col-md-9"></td>
            </tr>
            <tr>
                <td class="col-md-3">&emsp;a. Nama Lengkap</td>
                <td class="col-md-9">: <?=@$list->nama_ketua_peneliti?></td>
            </tr>
            <?php 
            $data_dosen = $this->M_simuk->ambil('id_pegawai',$list->ketua_peneliti, 'tb_pegawai')->row();
            $gol = $this->M_ref->ambil_('id_pangkat_gol', $data_dosen->kd_pangkat_gol, 'pangkat_golongan')->row();
            $jab = $this->M_simuk->ambil('kd_jabatan',$data_dosen->kd_jabatan, 'tb_jabatan')->row();
            $unit = $this->M_simuk->ambil('kd_unit',$data_dosen->kd_unit, 'tb_unit')->row();
            $jml_dosen = $this->Model->ambil('id_proposal',$list->id_proposal,'tb_afiliasi_dosen')->num_rows();
            $afiliasi_dosen = $this->Model->ambil('id_proposal',$list->id_proposal,'tb_afiliasi_dosen')->result();
            $jml_mhs = $this->Model->ambil('id_proposal',$list->id_proposal,'tb_afiliasi_mhs')->num_rows();
            $afiliasi_mhs = $this->Model->ambil('id_proposal',$list->id_proposal,'tb_afiliasi_mhs')->result();
            $mitra = $this->Model->ambil('id_proposal',$list->id_proposal,'tb_mitra')->result();
            ?>
            <tr>
                <td class="col-md-3">&emsp;b. NIDN</td>
                <td class="col-md-9">: <?=@$data_dosen->nidn?></td>
            </tr>
            <tr>
                <td class="col-md-3">&emsp;c. Pangkat / Golongan</td>
                <td class="col-md-9">: <?=@$gol->nm_pangkat?>/<?=@$gol->kode_gol?></td>
            </tr>
            <tr>
                <td class="col-md-3">&emsp;d. Jabatan Fungsional</td>
                <td class="col-md-9">: <?=@$jab->nama_jabatan?></td>
            </tr>
            <tr>
                <td class="col-md-3">&emsp;e. Program Studi</td>
                <td class="col-md-9">: <?=@$list->nama_prodi?></td>
            </tr>
            <tr>
                <td class="col-md-3">&emsp;f. Telp/HP</td>
                <td class="col-md-9">: <?=@$data_dosen->no_hp?></td>
            </tr>
            <tr>
                <td class="col-md-3">&emsp;g. Alamat E-mail</td>
                <td class="col-md-9">: <?=@$data_dosen->email?></td>
            </tr>
            <tr>
                <td class="col-md-3">3. Anggota Tim</td>
                <td class="col-md-9"></td>
            </tr>
            <tr>
                <td class="col-md-3">&emsp;a. Jumlah anggota</td>
                <td class="col-md-9">: dosen <?=@$jml_dosen?> orang</td>
            </tr>
            <?php foreach($afiliasi_dosen as $ad){ ?>
            <tr>
                <td class="col-md-3">&emsp;&emsp;Nama Anggota</td>
                <td class="col-md-9">: <?=@$ad->nama_anggota?></td>
            </tr>
            <?php }?>
            <tr>
                <td class="col-md-3">&emsp;b. Mahasiswa yang terlibat</td>
                <td class="col-md-9">: <?=@$jml_mhs?> orang</td>
            </tr>
            <?php foreach($afiliasi_mhs as $am){ ?>
            <tr>
                <td class="col-md-3">&emsp;&emsp;Nama Mahasiswa</td>
                <td class="col-md-9">: <?=@$am->nama_mhs?></td>
            </tr>
            <?php }?>
             <tr>
                <td class="col-md-3">4. Kemitraan</td>
                <td class="col-md-9"></td>
            </tr>
            <?php foreach($mitra as $m){ ?>
            <tr>
                <td class="col-md-3">&emsp;&emsp;Nama Mitra Program</td>
                <td class="col-md-9">: <?=@$m->nama_mitra?></td>
            </tr>
            <tr>
                <td class="col-md-3">&emsp;&emsp;Wilayah</td>
                <td class="col-md-9">: <?=@$m->propinsi?></td>
            </tr>
            <tr>
                <td class="col-md-3">&emsp;&emsp;Kabupaten</td>
                <td class="col-md-9">: <?=@$m->kabupaten?></td>
            </tr>
            <tr>
                <td class="col-md-3">&emsp;&emsp;Jarak ke lokasi mitra</td>
                <td class="col-md-9">: <?=@number_format($m->jarak_lokasi)?> km</td>
            </tr>
            <tr>
                <td colspan="2"><br></td>
            </tr>
            <?php }?>
             <tr>
                <td class="col-md-3">5. Jangka waktu pelaksanaan</td>
                <td class="col-md-9">: <?=@$list->lama_penelitian?> tahun</td>
            </tr>
            <tr>
                <td class="col-md-3">6. Biaya PkM</td>
                <td class="col-md-9"></td>
            </tr>
            <tr>
                <td class="col-md-3">&emsp;a. Hibah Mandiri</td>
                <td class="col-md-9">: Rp.<?=@number_format($list->biaya_diusulkan)?></td>
            </tr>
            <tr>
                <td class="col-md-3">&emsp;b. Sumber Lain</td>
                <td class="col-md-9">: Rp.<?=@number_format($list->sumber_lain)?></td>
            </tr>
            <tr>
                <td class="col-md-3">&emsp;Jumlah</td>
                <th class="col-md-9">: Rp.<?=@number_format($list->biaya_diusulkan+$list->sumber_lain)?></th>
            </tr>
            <tr>
                <td><br><br></td>
                <td></td>
            </tr>
            </table>

            <table width="100%">
            <tr>
                <td class="col-md-3"></td>
                <td class="col-md-9"><div style="float:right;">Lampung Selatan, <?=date('d-m-Y')?></div></td>
            </tr>
            <tr>
                <td class="col-md-3">Mengetahui,</td>
                <td class="col-md-9"><div style="float:right;">Ketua Tim Pengusul &emsp;&emsp;</div></td>
            </tr>
            <tr>
                <td class="col-md-3">Ketua Jurusan</td>
                <td class="col-md-9"></td>
            </tr>
            <tr>
                <td><br><br><br></td>
                <td></td>
            </tr>
            <?php 
            $get_sesjur = $this->M_simuk->ambil('kd_unit',$list->kd_unit, 'tb_unit')->row();
            $get_sesjur = $get_sesjur->parent;

            if ($get_sesjur == 19) {
                $nm_kajur = 'Dr. Rahayu Sulistyorini, S.T., M.T.';
                $nip_kajur = '197410042000032002';
                
            }else{
                
                $nm_kajur = 'Prof. Dr. L. Hari Wiryanto, M.S.';
                $nip_kajur = '196104111986011001';
            }

            // $sesprodi = $this->M_simuk->list_join_where('tb_pegawai','tb_ref_level','tb_pegawai.id_pegawai=tb_ref_level.id_pegawai','tb_ref_level.kd_unit', $list->kd_unit)->row();

            // $sesjur = $this->M_simuk->simuk->query("select * from tb_pegawai join tb_ref_level on tb_pegawai.id_pegawai=tb_ref_level.id_pegawai where tb_ref_level.kd_unit = '$kd_sesjur' AND tb_ref_level.id_pegawai NOT IN('PEG0141','PEG0326') AND tb_ref_level.level = 'sesjur'")->row();
            ?>
            <tr>
                <td class="col-md-3"><?=@$nm_kajur?></td>
                <td class="col-md-9"><div style="float:right;"><?=@$list->nama_ketua_peneliti?></div></td>
            </tr>

            <tr>
                <td class="col-md-3">NIP. <?=@$nip_kajur?> </td>
                <td class="col-md-9"><div style="float:right;">NIP/NRK <?php if(!empty($data_dosen->NIP)) {echo @$data_dosen->NIP; }else{ echo @$data_dosen->NRK; } ?></div></td>
            </tr>
            <tr>
                <td colspan="2"><center>Menyetujui<br>Ketua LP3</center></td>
            </tr>
            <tr>
                <td><br><br><br></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"><center>Prof. Dr. Sukrasno, M.S.<br>NIP. 195809101985031004</center></td>
            </tr>
        </table>
    </center>
</font>
  </body>
  </html>