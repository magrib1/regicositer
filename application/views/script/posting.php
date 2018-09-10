<script type="text/javascript">
	$(document).on('click', '#tambah_mod_posting', function(e){
        e.preventDefault();
        $('#tambah_posting').modal();
        $('#action').val('tambah');
        $('#judul_posting').val('');
        $('#tgl_posting').val('');
        $('#isi_posting').val('');
    });

     $(document).on('submit', '#form_posting', function(e){
        e.preventDefault();
        $('#notif_sukses').html('Loading...');
        var data = new FormData(document.getElementById('form_posting'));
        var action = $('#action').val();

        if(action == 'tambah'){
            $.ajax({
                url : '<?=base_url()?>admin/posting/tambah_posting',
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
                url : '<?=base_url()?>admin/posting/ubah_posting',
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

    $(document).on('click', '.ubah_posting', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#tambah_posting').modal();
        $('#id_posting').val(id);
        $('#action').val('edit');
        $.ajax({
            url: '<?=base_url()?>admin/posting/ambil_posting',
            type: 'POST',
            data: 'id='+id,
            dataType: 'JSON',
            success: function(msg){
                $('#judul_posting').val(msg.judul_posting);
                $('#tgl_posting').val(msg.tgl_posting);
                CKEDITOR.instances.isi_posting.setData(msg.isi_posting);
            }
        });
    });

    $(document).on('click', '.hapus_file_posting', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#hapus_file_posting').modal();
        $('#id_posting').val(id);
        $.ajax({
            url: '<?=base_url()?>admin/posting/ambil_file_posting',
            type: 'POST',
            data: 'id='+id,
            dataType: 'JSON',
            success: function(msg){
               $('#token').val(msg.token);
            }
        });
    });

    $(document).on('click', '.hapus_posting', function(msg){
        $('#modalHapus').modal();
        var id = $(this).attr('id');
        $('#id_hapus').val(id);
    });

    $(document).on('click', '.btn_close', function(e){
        e.preventDefault();
        location.reload();
    });

    $(document).on('click', '.btn_hapus_posting', function(e){
        var id = $('#id_hapus').val();
        $.ajax({
            url: '<?=base_url()?>admin/posting/hapus_posting',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });
</script>