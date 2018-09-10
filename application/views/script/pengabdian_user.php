<script type="text/javascript">
	$(document).ready(function(){
    	//auto complete
        $(document).on('keyup', "#nama_pegawai", function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?=base_url()?>user/pengabdian/auto_pegawai",
                data: {
                    nama_pegawai: $("#nama_pegawai").val()
                },
                dataType: "json",
                success: function (data) {
                    if (data.length > 0) {
                        $('#DropdownCountry').empty();
                        $('#nama_pegawai').attr("data-toggle", "dropdown");
                        $('#DropdownCountry').dropdown('toggle');
                    }
                    else if (data.length == 0) {
                        $('#nama_pegawai').attr("data-toggle", "");
                    }
                    $.each(data, function (key,value) {
                        if (data.length >= 0)
                            $('#DropdownCountry').append('<li role="presentation" ><a href="#">' + value['id_pegawai']+' - '+value['nama_pegawai'] + '</a></li>');
                    });
                }
            });
        });
        $('ul.txtcountry').on('click', 'li a', function () {
            $('#nama_pegawai').val($(this).text());
        });
        //end auto complete

        //auto complete
        $(document).on('keyup', "#afiliasi_dosen", function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?=base_url()?>user/pengabdian/auto_pegawai",
                data: {
                    nama_pegawai: $("#afiliasi_dosen").val()
                },
                dataType: "json",
                success: function (data) {
                    if (data.length > 0) {
                        $('#DropdownCountry2').empty();
                        $('#afiliasi_dosen').attr("data-toggle", "dropdown");
                        $('#DropdownCountry2').dropdown('toggle');
                    }
                    else if (data.length == 0) {
                        $('#afiliasi_dosen').attr("data-toggle", "");
                    }
                    $.each(data, function (key,value) {
                        if (data.length >= 0)
                            $('#DropdownCountry2').append('<li role="presentation" ><a href="#">' + value['id_pegawai']+' - '+value['nama_pegawai'] + '</a></li>');
                    });
                }
            });
        });
        $('ul.txtcountry2').on('click', 'li a', function () {
            $('#afiliasi_dosen').val($(this).text());
        });
        //end auto complete

        //auto complete
            $(document).on('keyup', "#afiliasi_mhs", function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>user/pengabdian/auto_mhs",
                    data: {
                        nama_mhs: $("#afiliasi_mhs").val()
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.length > 0) {
                            $('#DropdownCountry3').empty();
                            $('#afiliasi_mhs').attr("data-toggle", "dropdown");
                            $('#DropdownCountry3').dropdown('toggle');
                        }
                        else if (data.length == 0) {
                            $('#afiliasi_mhs').attr("data-toggle", "");
                        }
                        $.each(data, function (key,value) {
                            if (data.length >= 0)
                                $('#DropdownCountry3').append('<li role="presentation" ><a href="#">' + value['nim']+' - '+value['nama_mhs'] + '</a></li>');
                        });
                    }
                });
            });
            $('ul.txtcountry3').on('click', 'li a', function () {
                $('#afiliasi_mhs').val($(this).text());
            });
            //end auto complete

             //auto complete
            $(document).on('keyup', "#nama_prodi", function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "<?=base_url()?>user/penelitian/auto_prodi",
                    data: {
                        nama_mhs: $("#nama_prodi").val()
                    },
                    dataType: "json",
                    success: function (data) {
                        if (data.length > 0) {
                            $('#DropdownCountryx').empty();
                            $('#nama_prodi').attr("data-toggle", "dropdown");
                            $('#DropdownCountryx').dropdown('toggle');
                        }
                        else if (data.length == 0) {
                            $('#nama_prodi').attr("data-toggle", "");
                        }
                        $.each(data, function (key,value) {
                            if (data.length >= 0)
                                $('#DropdownCountryx').append('<li role="presentation" ><a href="#">' + value['kd_unit']+' - '+value['nama_unit'] + '</a></li>');
                        });
                    }
                });
            });
            $('ul.txtcountryx').on('click', 'li a', function () {
                $('#nama_prodi').val($(this).text());
            });
            //end auto complete


    $(document).on('click', '.usulan', function(e){
        //var id = $('#id_hapus').val();
        e.preventDefault();
        $('#notif').html('Loading....');
        var data = new FormData(document.getElementById('form_usulan_proposal'));
        $.ajax({
            url: '<?=base_url()?>user/pengabdian/ubah_usulan',
            type: 'POST',
            data: data,
            contentType:false,
            processData:false,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });

    $(document).on('click', '.afiliasi_dosen', function(e){
        //var id = $('#id_hapus').val();
        e.preventDefault();
        $('#notif').html('Loading....');
        var data = new FormData(document.getElementById('form_afiliasi_dosen'));
        $.ajax({
            url: '<?=base_url()?>user/pengabdian/simpan_afiliasi_dosen',
            type: 'POST',
            data: data,
            contentType:false,
            processData:false,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });

     $(document).on('click', '.hapus_afiliasi_dosen', function(e){
        var id = $('#id_hapus').val();
        $.ajax({
            url: '<?=base_url()?>user/pengabdian/hapus_afiliasi_dosen',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });

    $(document).on('click', '.afiliasi_mahasiswa', function(e){
        //var id = $('#id_hapus').val();
        e.preventDefault();
        $('#notif').html('Loading....');
        var data = new FormData(document.getElementById('form_afiliasi_mahasiswa'));
        $.ajax({
            url: '<?=base_url()?>user/pengabdian/simpan_afiliasi_mhs',
            type: 'POST',
            data: data,
            contentType:false,
            processData:false,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });

     $(document).on('click', '.hapus_afiliasi_mahasiswa', function(e){
        var id = $('#id_hapus2').val();
        $.ajax({
            url: '<?=base_url()?>user/pengabdian/hapus_afiliasi_mhs',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });

      $(document).on('click', '.mitra', function(e){
        //var id = $('#id_hapus').val();
        e.preventDefault();
        $('#notif').html('Loading....');
        var data = new FormData(document.getElementById('form_mitra'));
        $.ajax({
            url: '<?=base_url()?>user/pengabdian/simpan_mitra',
            type: 'POST',
            data: data,
            contentType:false,
            processData:false,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });

     $(document).on('click', '.hapus_mitra', function(e){
        var id = $('#id_hapus3').val();
        $.ajax({
            url: '<?=base_url()?>user/pengabdian/hapus_mitra',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });

    $(document).on('click', '.finish', function(e){
        window.location.href="<?=base_url()?>user/pengabdian";
    });

    $(document).on('click', '.hapus_usulan', function(e){
        e.preventDefault();
        $('#modalHapus').modal();
        var id = $(this).attr('id');
        $('#id_hapus').val(id);
    });

    $(document).on('click', '.upload_proposal', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#id_proposal').val(id);
        $('#upload_proposal').modal();
    });

    $(document).on('click', '.lihat_proposal', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#id_proposal_').val(id);
        $('#lihat_proposal').modal();
        $.ajax({
            url: '<?=base_url()?>user/pengabdian/ambil_file',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#result').html(msg);
            }
        });
    });

    $(document).on('click', '.lihat_proposal2', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#id_proposal_').val(id);
        $('#lihat_proposal2').modal();
        $.ajax({
            url: '<?=base_url()?>user/pengabdian/ambil_file',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#result2').html(msg);
            }
        });
    });

    $(document).on('click', '.komentar', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#id_proposal_').val(id);
        $('#komentar').modal();
        $.ajax({
            url: '<?=base_url()?>user/pengabdian/ambil_komentar',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#result3').html(msg);
            }
        });
    });

    $(document).on('click', '.btn_close', function(e){
        e.preventDefault();
        location.reload();
    });

    $(document).on('click', '.btn_hapus_usulan', function(e){
        var id = $('#id_hapus').val();
        $.ajax({
            url: '<?=base_url()?>user/pengabdian/hapus_usulan',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });

    $(document).on('click', '.btn_upload_proposal', function(e){
        //var id = $('#id_hapus').val();
        e.preventDefault();
        $('#notif').html('Loading....');
        var data = new FormData(document.getElementById('form_upload_proposal'));
        $.ajax({
            url: '<?=base_url()?>user/pengabdian/upload_proposal',
            type: 'POST',
            data: data,
            contentType:false,
            processData:false,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });

    $(document).on('click', '.btn_hapus_proposal', function(e){
        //var id = $('#id_hapus').val();
        e.preventDefault();
        $('#notif').html('Loading....');
        var data = new FormData(document.getElementById('form_delete_proposal'));
        $.ajax({
            url: '<?=base_url()?>user/pengabdian/hapus_file_proposal',
            type: 'POST',
            data: data,
            contentType:false,
            processData:false,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });

    $('#Radios1').change(function(){
        if ($(this,':checked')){
            $('#id_kategori').attr('disabled', true);
            $('#id_kategori').val('0');
        }
    });

    $('#Radios2').change(function(){
        if ($(this,':checked')){
            $('#id_kategori').attr('disabled', false);
        }
    });

    var isChecked = $('#Radios1').attr('checked')?$('#id_kategori').attr('disabled', true):false;    

});

</script>