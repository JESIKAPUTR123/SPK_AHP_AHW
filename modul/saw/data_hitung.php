<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-home"></i> Data Pehitungan Metode SAW</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama RW</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
              $sql = $koneksi->query("select * from rw order by id_rw asc");
              while ($data= $sql->fetch_assoc()) {
            ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['nama_rw']; ?>
						</td>
						<td>
							<a href="?page=data-saw&kode=<?php echo $data['id_rw']; ?>" title="Ubah"
							 class="btn btn-success btn-sm">
								<i class="fa fa-cogs"></i> Lihat Analisa
							</a>
						</td>
					</tr>

					<?php
              }
            ?>
				</tbody>
				</tfoot>
			</table>
		</div>
	</div>
	<!-- /.card-body -->