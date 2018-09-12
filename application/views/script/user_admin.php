<script type="text/javascript">
	$(document).on('click', '#tambah_mod_user', function(e){
        e.preventDefault();
        $('#tambah_user').modal();
        $('#action').val('tambah');
        
        $('#username').val('');
        $('#password').val('');
    });

     $(document).on('submit', '#form_user', function(e){
        e.preventDefault();
        $('#notif_sukses').html('Loading...');
        var data = new FormData(document.getElementById('form_user'));
        var action = $('#action').val();

        if(action == 'tambah'){
            $.ajax({
                url : '<?=base_url()?>admin/user/tambah_user',
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
                url : '<?=base_url()?>admin/user/ubah_user',
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

    $(document).on('click', '.ubah_user', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#tambah_user').modal();
        $('#id_user').val(id);
        $('#action').val('edit');
        $.ajax({
            url: '<?=base_url()?>admin/user/ambil_user',
            type: 'POST',
            data: 'id='+id,
            dataType: 'JSON',
            success: function(msg){
                $('#username').val(msg.username);
            }
        });
    });

    $(document).on('click', '.hapus_file_user', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#hapus_file_user').modal();
        $('#id_user').val(id);
        $.ajax({
            url: '<?=base_url()?>admin/user/ambil_file_user',
            type: 'POST',
            data: 'id='+id,
            dataType: 'JSON',
            success: function(msg){
               $('#token').val(msg.token);
            }
        });
    });

    $(document).on('click', '.hapus_user', function(msg){
        $('#modalHapus').modal();
        var id = $(this).attr('id');
        $('#id_hapus').val(id);
    });

    $(document).on('click', '.btn_close', function(e){
        e.preventDefault();
        location.reload();
    });

    $(document).on('click', '.btn_hapus_user', function(e){
        var id = $('#id_hapus').val();
        $.ajax({
            url: '<?=base_url()?>admin/user/hapus_user',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });
</script>