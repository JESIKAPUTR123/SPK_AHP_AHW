<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-sitemap"></i> Data Sub kriteria</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=add-sub" class="btn btn-success">
					<i class="fa fa-plus"></i> Tambah Data</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama kriteria</th>
						<th>Sub Kriteria</th>
						<th>Nilai</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
              $sql = $koneksi->query("select * from sub,kriteria where sub.id_kriteria=kriteria.id_kriteria order by sub.id_sub desc");
              while ($data= $sql->fetch_assoc()) {
            ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['nama_kriteria']; ?>
						</td>
						<td>
							<?php echo $data['nama_sub']; ?>
						</td>
						<td>
							<?php echo $data['nilai']; ?>
						</td>
						<td>
							<a href="?page=edit-sub&kode=<?php echo $data['id_sub']; ?>" title="Ubah"
							 class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-sub&kode=<?php echo $data['id_sub']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
							 title="Hapus" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i>
								</>
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