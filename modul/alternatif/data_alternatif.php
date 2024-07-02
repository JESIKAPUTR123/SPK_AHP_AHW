<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-users"></i> Data Alternatif</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=add-alternatif" class="btn btn-success">
					<i class="fa fa-plus"></i> Tambah Data</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>No KK</th>
						<th>RW</th>
						<th>NIK</th>
						<th>Nama</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
              $sql = $koneksi->query("select * from alternatif,rw where alternatif.id_rw=rw.id_rw order by alternatif.id_alternatif desc");
              while ($data= $sql->fetch_assoc()) {
            ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['no_kk']; ?>
						</td>
						<td>
							<?php echo $data['nama_rw']; ?>
						</td>
						<td>
							<?php echo $data['nik']; ?>
						</td>
						<td>
							<?php echo $data['nama']; ?>
						</td>

						<td>
							<a href="?page=edit-alternatif&kode=<?php echo $data['id_alternatif']; ?>" title="Ubah"
							 class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-alternatif&kode=<?php echo $data['id_alternatif']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
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