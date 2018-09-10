<script type="text/javascript">
	$(document).on('click', '#tambah_mod_reviewer', function(e){
        e.preventDefault();
        $('#tambah_reviewer').modal();
        $('#action').val('tambah');
        $('#nama_reviewer').val('');
        $('#no_hp').val('');
        $('#e_mail').val('');
        $('#username').val('');
        $('#password').val('');
    });

     $(document).on('submit', '#form_reviewer', function(e){
        e.preventDefault();
        $('#notif_sukses').html('Loading...');
        var data = new FormData(document.getElementById('form_reviewer'));
        var action = $('#action').val();

        if(action == 'tambah'){
            $.ajax({
                url : '<?=base_url()?>admin/reviewer/tambah_reviewer',
                type : 'POST',
                data : data,
                processData: false, 
                contentType: false,
                success : function(msg){
                    $('#notif_sukses').html(msg);
                }
            });
        }else if(action == 'edit'){
            $.ajax({
                url : '<?=base_url()?>admin/reviewer/ubah_reviewer',
                type : 'POST',
                data : data,
                processData: false, 
                contentType: false,
                success : function(msg){
                    $('#notif_sukses').html(msg);
                }
            });
        }

    });

    $(document).on('click', '.ubah_reviewer', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#tambah_reviewer').modal();
        $('#id_reviewer').val(id);
        $('#action').val('edit');
        $.ajax({
            url: '<?=base_url()?>admin/reviewer/ambil_reviewer',
            type: 'POST',
            data: 'id='+id,
            dataType: 'JSON',
            success: function(msg){
                $('#nama_reviewer').val(msg.nama_reviewer);
                $('#no_hp').val(msg.no_hp);
                $('#e_mail').val(msg.e_mail);
                $('#username').val(msg.username);
            }
        });
    });

    $(document).on('click', '.hapus_file_reviewer', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#hapus_file_reviewer').modal();
        $('#id_reviewer').val(id);
        $.ajax({
            url: '<?=base_url()?>admin/reviewer/ambil_file_reviewer',
            type: 'POST',
            data: 'id='+id,
            dataType: 'JSON',
            success: function(msg){
               $('#token').val(msg.token);
            }
        });
    });

    $(document).on('click', '.hapus_reviewer', function(msg){
        $('#modalHapus').modal();
        var id = $(this).attr('id');
        $('#id_hapus').val(id);
    });

    $(document).on('click', '.btn_close', function(e){
        e.preventDefault();
        location.reload();
    });

    $(document).on('click', '.btn_hapus_reviewer', function(e){
        var id = $('#id_hapus').val();
        $.ajax({
            url: '<?=base_url()?>admin/reviewer/hapus_reviewer',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });
</script>