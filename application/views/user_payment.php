<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/bootstrap/theme/bootstrap.min.css">
    <title>Icositer Fullpaper & Payment</title>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/jquery-ui.min.js"></script>
   
    <!-- Latest compiled JavaScript -->
    <script src="<?=base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/jsmultiple.js"></script>
    <link rel="stylesheet" href="<?=base_url()?>assets/style.css" type="text/css" media="screen" />
     <link rel="stylesheet" href="<?=base_url()?>assets/stylemultiple.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?=base_url()?>assets/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/dataTable/media/css/uikit.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/dataTable/media/css/dataTables.uikit.min.css">
    <link rel="stylesheet" href="<?=base_url()?>assets/bootstrap-treeview.min.css">
    <link rel="shortcut icon" href="<?=base_url()?>assets/logo%20itera%20oke.png">    
    <script src="<?=base_url()?>assets/dataTable/media/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>assets/dataTable/media/js/dataTables.uikit.min.js"></script>
    <script src="<?=base_url()?>assets/bootstrap-treeview.min.js"></script>
    <script src="<?=base_url()?>assets/ckeditor/ckeditor.js"></script>

    <!--  Highchart -->
    <script src="<?php echo base_url();?>assets/Highcharts-5.0.6/highcharts.js"></script>
    <script src="<?php echo base_url();?>assets/Highcharts-5.0.6/modules/exporting.js"></script>
    <script src="<?php echo base_url();?>assets/Highcharts-5.0.6/themes/grid-light.js"></script>

    <?php include './assets/act.php'; ?>     
  </head>
  <body>
<div class="panel panel-default">
	<div class="panel-heading">
		<i class="fa fa-list" aria-hidden="true"></i> Form Upload Payment
       	
	</div>
	<div class="panel-body">
		<form id="form_payment" method="POST" >
                 <br>
                <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <th class="col-md-3">Author</th>
                        <td class="col-md-9"><input type="text" name="author" id="author" class="form-control" required></td>
                    </tr>
                   
                    <tr>
                        <th class="col-md-3">E-Mail</th>
                        <td class="col-md-9">
                            <input type="email" id="email" name="email" class="form-control">
                        </td>
                    </tr>
                    
                    <tr>
                        <th class="col-md-3">File</th>
                        <td class="col-md-9">
                            <input type="file" id="payment_upload" name="payment_upload" class="form-control" required>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div id="notif_sukses"></div>
                        </td>
                        <td>
                            <div style="float:right;">
                                <input type="submit" name="simpan" value="Submit" class=" btn btn-warning">
                                <input type="text" style="display: none" name="id_payment" id="id_payment"/>
                                <input type="text" style="display: none" name="action" id="action"/>
                            </div>
                        </td>
                    </tr>
                </table>
               </form>
	</div>
</div>
</body>
<script type="text/javascript">
    $(document).ready(function(){
        //$('#tambah_payment').modal();
        $('#action').val('tambah');
    });

    $(document).on('submit', '#form_payment', function(e){
        e.preventDefault();
        $('#notif_sukses').html('Loading...');
        var data = new FormData(document.getElementById('form_payment'));
        var action = $('#action').val();

        if(action == 'tambah'){
            $.ajax({
                url : '<?=base_url()?>user/payment/tambah_payment',
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
                url : '<?=base_url()?>user/payment/ubah_payment',
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
</script>
</html>