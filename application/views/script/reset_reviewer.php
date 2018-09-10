<script type="text/javascript">
	$(document).on('click', '#submit', function(e){
        e.preventDefault();
        $('#notif').html('Loading....');
        var data = new FormData(document.getElementById('form_reset'));
        $.ajax({
            url: '<?=base_url()?>reviewer/reset/reset',
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