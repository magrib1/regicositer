<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/bootstrap/theme/bootstrap.min.css">
    <title>Icositer FullPaper & Payment</title>
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
		<i class="fa fa-list" aria-hidden="true"></i> Payment Submitted
       	
	</div>
	<div class="panel-body">
		 <div class="table-responsive"> 
        <table id="daftar" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th width="col-md-1">No</th>
                    <th width="col-md-5">Author</th>
                    <th width="col-md-5">E-mail</th>
                    <th width="col-md-5">File</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no=1;
                foreach($list as $l){
                ?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$l->author?></td>
                <td><?=$l->email?></td>
                <td> <?php if(empty($l->payment_upload)){ echo "-"; }else{ ?> <img src="<?=base_url()?>assets/file_upload/<?=$l->payment_upload?>" width="300px" class="img-thumbnail" > <?php } ?> </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
        </div>
    </div>
	</div>
</div>
</body>
</html>