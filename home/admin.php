<?php

  $sql = $koneksi->query("SELECT COUNT(id_alternatif) as alternatif from alternatif");
  while ($data= $sql->fetch_assoc()) {
    $alter=$data['alternatif'];
  }

  $sql = $koneksi->query("SELECT COUNT(id_kriteria) as kri from kriteria");
  while ($data= $sql->fetch_assoc()) {
    $kri=$data['kri'];
  }

  $sql = $koneksi->query("SELECT COUNT(id_sub) as sub from sub");
  while ($data= $sql->fetch_assoc()) {
    $sub=$data['sub'];
  }

  $sql = $koneksi->query("SELECT COUNT(id_nilai) as nilai from nilai");
  while ($data= $sql->fetch_assoc()) {
    $nilai=$data['nilai'];
  }

 

?>

<div class="row">
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-info">
			<div class="inner">
				<h3>
					<?php echo $alter;  ?>
				</h3>

				<p>Data Alternatif</p>
			</div>
			<div class="icon">
				<i class="ion ion-person-add"></i>
			</div>
			<?php 
			if ($data_level=="Kepala Desa"){

			}else{
				?> 
				<a href="index.php?page=data-alternatif" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
				 <?php
			}
			 ?>
			
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-success">
			<div class="inner">
				<h3>
					<?php echo $kri;  ?>
				</h3>

				<p>Data Kriteria</p>
			</div>
			<div class="icon">
				<i class="fas fa-list"></i>
			</div>
			<?php 
			if ($data_level=="Kepala Desa"){

			}else{
				?> 
				<a href="index.php?page=data-kriteria" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
				 <?php
			}
			 ?>
			
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-red">
			<div class="inner">
				<h3>
					<?php echo $sub;  ?>
				</h3>

				<p>Data Sub Kriteria</p>
			</div>
			<div class="icon">
				<i class="fas fa-sitemap"></i>
			</div>
			<?php 
			if ($data_level=="Kepala Desa"){

			}else{
				?> 
				<a href="index.php?page=data-sub" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
				 <?php
			}
			 ?>
			
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-warning">
			<div class="inner">
				<h3>
					<?php echo $nilai;  ?>
				</h3>

				<p>Penilaian Alternatif</p>
			</div>
			<div class="icon">
				<i class="fas fa-pencil-alt"></i>
			</div>
			<?php 
			if ($data_level=="Kepala Desa"){

			}else{
				?> 
				<a href="index.php?page=data-nilai" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
				 <?php
			}
			 ?>
			
		</div>
	</div>

	

</div>

