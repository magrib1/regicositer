<script>
$(document).ready(function(){
    
    var base_url = '<?=base_url()?>';
    $('.input-tanggal').datepicker({
            dateFormat: 'yyyy-mm-dd',
        });

        $('#daftar').dataTable();

        $('#no_search').dataTable( {
		  "searching": false
		} );
});

</script>