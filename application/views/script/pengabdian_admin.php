<script type="text/javascript">
	
$(document).on('click', '.approve', function(msg){
        $('#modalapprove').modal();
        var id = $(this).attr('id');
         $('#id_proposal').val(id);
    });

$(document).on('click', '.btn_close', function(e){
    e.preventDefault();
    location.reload();
});

$(document).on('click', '.btn_approve', function(e){
    var id = $('#id_proposal').val();
     e.preventDefault();
        $('#notif').html('Loading....');
        var data = new FormData(document.getElementById('form_approve'));
        $.ajax({
            url: '<?=base_url()?>admin/pengabdian/ubah_approve',
            type: 'POST',
            data: data,
            contentType:false,
            processData:false,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
}); 

$(document).on('click', '.btn_reviewer', function(e){
     e.preventDefault();
        $('#notif').html('Loading....');
        var data = new FormData(document.getElementById('form_reviewer'));
        $.ajax({
            url: '<?=base_url()?>admin/pengabdian/tambah_reviewer',
            type: 'POST',
            data: data,
            contentType:false,
            processData:false,
            success: function(msg){
                $('#notif').html(msg);
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

    $(document).on('click', '.btn_hapus_kategori', function(e){
        var id = $('#id_hapus').val();
        $.ajax({
            url: '<?=base_url()?>admin/pengabdian/hapus_reviewer',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });

    $(document).on('click', '.hapus_usulan', function(e){
        e.preventDefault();
        $('#modalHapus').modal();
        var id = $(this).attr('id');
        $('#id_hapus').val(id);
    });

    $(document).on('click', '.btn_close', function(e){
        e.preventDefault();
        location.reload();
    });

    $(document).on('click', '.btn_hapus_usulan', function(e){
        var id = $('#id_hapus').val();
        $.ajax({
            url: '<?=base_url()?>admin/pengabdian/hapus_usulan',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });

     $(document).on('click', '.dana', function(msg){
        $('#modalDana').modal();
        var id = $(this).attr('id');
         $('#id_proposal2').val(id);
    });

    $(document).on('click', '.btn_dana', function(e){
    var id = $('#id_proposal2').val();
     e.preventDefault();
        $('#notif').html('Loading....');
        var data = new FormData(document.getElementById('form_dana'));
        $.ajax({
            url: '<?=base_url()?>admin/pengabdian/ubah_dana',
            type: 'POST',
            data: data,
            contentType:false,
            processData:false,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    }); 


</script>