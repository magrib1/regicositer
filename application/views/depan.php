
<div class="panel panel-primary">
		<div class="panel-heading">
			<i class="fa fa-home" aria-hidden="true"> Pengumuman</i>
			<div style="float:right;"></div>
		</div>
		<div class="panel-body">
			<?php foreach ($list_latest as $post) {
				?>
			<h3><?=$post->judul_posting?></h3>
			<hr/>
			<p> <?=$post->isi_posting?> </p>
			<?php } ?>
		</div>
</div>