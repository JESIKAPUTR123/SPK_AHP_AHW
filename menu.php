	<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

						<!-- Level  -->
						<?php
          if ($data_level=="admin"){
        ?>
						<li class="nav-item">
							<a href="index.php" class="nav-link">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>
									Dashboard
								</p>
							</a>
						</li>
						<li class="nav-header">Master Data</li>
						<li class="nav-item">
							<a href="?page=data-rw" class="nav-link">
								<i class="nav-icon fas fa-home"></i>
								<p>
									Data Rukun Warga
								</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="?page=data-alternatif" class="nav-link">
								<i class="nav-icon fas fa-users"></i>
								<p>
									Data Alternatif
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="?page=data-kriteria" class="nav-link">
								<i class="nav-icon fas fa-list"></i>
								<p>
									Data Kriteria
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="?page=data-sub" class="nav-link">
								<i class="nav-icon fas fa-sitemap"></i>
								<p>
									Data Sub Kriteria
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="?page=data-nilai" class="nav-link">
								<i class="nav-icon fas fa-pencil-alt"></i>
								<p>
									Penilaian Alternatif
								</p>
							</a>
						</li>

						<li class="nav-header">AHP</li>

						<li class="nav-item">
							<a href="?page=data-bobot" class="nav-link">
								<i class="nav-icon fas fa-sync"></i>
								<p>
									Pembobotan Kriteria
								</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="?page=data-pendidikan" class="nav-link">
								<i class="nav-icon fas fa-sync"></i>
								<p>
									Pembobotan Pendidikan
								</p>
							</a>
						</li>

						<li class="nav-header">SAW</li>

						<li class="nav-item">
							<a href="?page=data-hitung" class="nav-link">
								<i class="nav-icon fas fa-signal"></i>
								<p>
									Perhitungan Akhir
								</p>
							</a>
						</li>


					

						<?php
          				}
          				else if ($data_level=="Kepala Desa"){
          					?> 
	<li class="nav-header">SAW</li>

						<li class="nav-item">
							<a href="?page=data-hitung" class="nav-link">
								<i class="nav-icon fas fa-signal"></i>
								<p>
									Perhitungan Akhir
								</p>
							</a>
						</li>
          					 <?php
          				}
          	

          				?>

<li class="nav-header"></li>

						<li class="nav-item">
							<a onclick="return confirm('Apakah anda yakin akan keluar ?')" href="logout.php" class="nav-link">
								<i class="nav-icon fas fa-arrow-circle-right"></i>
								<p>
									Logout
								</p>
							</a>
						</li>

				</nav>