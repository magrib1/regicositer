<script type="text/javascript">
    $(document).ready(function(){
        //$('#tambah_payment').modal();
        //$('#action').val('tambah');
    });

    $(document).on('click', '#tambah_mod_payment', function(e){
        e.preventDefault();
        $('#tambah_payment').modal();
        $('#action').val('tambah');
        $('#author').val('');
        $('#email').val('');
        $('#approve').val('');
    });

    $(document).on('submit', '#form_payment', function(e){
        e.preventDefault();
        $('#notif_sukses').html('Loading...');
        var data = new FormData(document.getElementById('form_payment'));
        var action = $('#action').val();

        if(action == 'tambah'){
            $.ajax({
                url : '<?=base_url()?>admin/payment/tambah_payment',
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
                url : '<?=base_url()?>admin/payment/ubah_payment',
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

    $(document).on('click', '.ubah_payment', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#tambah_payment').modal();
        $('#id_payment').val(id);
        $('#action').val('edit');
        $.ajax({
            url: '<?=base_url()?>admin/payment/ambil_payment',
            type: 'POST',
            data: 'id='+id,
            dataType: 'JSON',
            success: function(msg){
                $('#author').val(msg.author);
                $('#email').val(msg.email);
                $('#title').val(msg.title);
                $('#id_sub_theme').val(msg.id_sub_theme);
                $('#approve').val(msg.approve);
            }
        });
    });

    $(document).on('click', '.hapus_file_payment', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        $('#hapus_file_payment').modal();
        $('#id_payment').val(id);
        $.ajax({
            url: '<?=base_url()?>admin/payment/ambil_file_payment',
            type: 'POST',
            data: 'id='+id,
            dataType: 'JSON',
            success: function(msg){
               $('#token').val(msg.token);
            }
        });
    });

    $(document).on('click', '.hapus_payment', function(msg){
        $('#modalHapus').modal();
        var id = $(this).attr('id');
        $('#id_hapus').val(id);
    });

    $(document).on('click', '.btn_close', function(e){
        e.preventDefault();
        location.reload();
    });

    $(document).on('click', '.btn_hapus_payment', function(e){
        var id = $('#id_hapus').val();
        $.ajax({
            url: '<?=base_url()?>admin/payment/hapus_payment',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });
</script>