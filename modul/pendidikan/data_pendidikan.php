<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-sync"></i> Data Perbandingan Kriteria Pendidikan</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				
			</div>
			<br>
			
	<?php 
		include('config.php');
	include('fungsi_pendidikan.php');
	 ?>


<section class="content">
	<h2 class="ui header">Perbandingan Kriteria Pendidikan</h2>
	<?php showTabelPerbandinganPendidikan('pendidikan','pendidikan'); ?>
</section>
		</div>
	</div>
	<!-- /.card-body -->