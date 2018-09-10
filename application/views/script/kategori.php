<script type="text/javascript">
	$(document).on('click', '#tambah_mod_kategori', function(e){
        e.preventDefault();
        $('#tambah_kategori').modal();
        $('#action').val('tambah');
        $('#nama_kategori').val('');
       
    });

     $(document).on('submit', '#form_kategori', function(e){
        e.preventDefault();
        $('#notif_sukses').html('Loading...');
        var data = new FormData(document.getElementById('form_kategori'));
        var action = $('#action').val();

        if(action == 'tambah'){
            $.ajax({
                url : '<?=base_url()?>admin/kategori/tambah_kategori',
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
                url : '<?=base_url()?>admin/kategori/ubah_kategori',
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

    $(document).on('click', '.ubah_kategori', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#tambah_kategori').modal();
        $('#id_kategori').val(id);
        $('#action').val('edit');
        $.ajax({
            url: '<?=base_url()?>admin/kategori/ambil_kategori',
            type: 'POST',
            data: 'id='+id,
            dataType: 'JSON',
            success: function(msg){
                $('#nama_kategori').val(msg.nama_kategori);
                
            }
        });
    });

    $(document).on('click', '.hapus_file_kategori', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#hapus_file_kategori').modal();
        $('#id_kategori').val(id);
        $.ajax({
            url: '<?=base_url()?>admin/kategori/ambil_file_kategori',
            type: 'POST',
            data: 'id='+id,
            dataType: 'JSON',
            success: function(msg){
               $('#token').val(msg.token);
            }
        });
    });

    $(document).on('click', '.hapus_kategori', function(msg){
        $('#modalHapus').modal();
        var id = $(this).attr('id');
        $('#id_hapus').val(id);
    });

    $(document).on('click', '.btn_close', function(e){
        e.preventDefault();
        location.reload();
    });

    $(document).on('click', '.btn_hapus_kategori', function(e){
        var id = $('#id_hapus').val();
        $.ajax({
            url: '<?=base_url()?>admin/kategori/hapus_kategori',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });
</script>