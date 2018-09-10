<script type="text/javascript">
	$(document).on('click', '.btn_simpan_nilai', function(e){
        //var id = $('#id_hapus').val();
        e.preventDefault();
        $('#notif').html('Loading....');
        var data = new FormData(document.getElementById('form_penilaian'));
        $.ajax({
            url: '<?=base_url()?>reviewer/penilaian_penelitian/update_nilai',
            type: 'POST',
            data: data,
            contentType:false,
            processData:false,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });

    $(document).on('click', '.btn_lock_nilai', function(e){
    	e.preventDefault();
        $('#modalLock').modal();
        var id = $(this).attr('id');
         $('#id_rev').val(id);
    });

    $(document).on('click', '.btn_lock', function(e){
        var id = $('#id_rev').val();
        $.ajax({
            url: '<?=base_url()?>reviewer/penilaian_penelitian/lock_nilai',
            type: 'POST',
            data: 'id='+id,
            success: function(msg){
                $('#notif').html(msg);
            }
        });
    });

    $(document).on('keyup', '#s1', function(e){
        e.preventDefault();
        var skor = $('#s1').val();

        if (skor > 7) {
            alert("Skor maksimal 7");
            $('#s1').val("7");
        }
       
    });

    $(document).on('keyup', '#s2', function(e){
        e.preventDefault();
        var skor = $('#s2').val();

        if (skor > 7) {
            alert("Skor maksimal 7");
            $('#s2').val("7");
        }
       
    });

    $(document).on('keyup', '#s3', function(e){
        e.preventDefault();
        var skor = $('#s3').val();

        if (skor > 7) {
            alert("Skor maksimal 7");
            $('#s3').val("7");
        }
       
    });

    $(document).on('keyup', '#s4', function(e){
        e.preventDefault();
        var skor = $('#s4').val();

        if (skor > 7) {
            alert("Skor maksimal 7");
            $('#s4').val("7");
        }
       
    });

    $(document).on('keyup', '#s5', function(e){
        e.preventDefault();
        var skor = $('#s5').val();

        if (skor > 7) {
            alert("Skor maksimal 7");
            $('#s5').val("7");
        }
       
    });

</script>