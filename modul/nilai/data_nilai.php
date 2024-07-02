<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-pencil-alt"></i> Data Penilaian Alternatif</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=add-nilai" class="btn btn-success">
					<i class="fa fa-plus"></i> Tambah Data</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					 <tr>
            
                        <th>No</th>
                        <th>Nama Alternatif</th>
                        <?php 
                        $sq = mysqli_query($koneksi,"select * from kriteria where nama_kriteria!='pendidikan'");
                        while ($da = mysqli_fetch_array($sq)) {
                          ?> 
                          <th><?php echo $da['nama_kriteria'] ?></th>
                           <?php
                        }
                         ?>
                          <?php 
                        $sq = mysqli_query($koneksi,"select * from pendidikan");
                        while ($da = mysqli_fetch_array($sq)) {
                          ?> 
                          <th><?php echo $da['nama_pendidikan'] ?></th>
                           <?php
                        }
                         ?>

                    <th>Aksi</th>
                       
                      </tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
              $sql = $koneksi->query("select * from nilai,alternatif where nilai.id_alternatif=alternatif.id_alternatif group by nilai.id_alternatif");
              while ($data= $sql->fetch_assoc()) {
            ?>

					<tr> 


                          <td><?php echo $no++ ?></td>
                          <td><?php echo $data['nama'] ?></td>
                          <?php 
                          $coba = mysqli_query($koneksi,"select * from kriteria,nilai,sub where kriteria.id_kriteria=sub.id_kriteria and nilai.id_sub=sub.id_sub and nilai.id_alternatif='$data[id_alternatif]'");
                          while ($iya = mysqli_fetch_array($coba)) {
                            ?> 
                            <td><?php echo $iya['nama_sub'] ?> <span class="badge badge-success">(<?php echo $iya['nilai'] ?>)</span></td>
                             <?php
                          }
                           ?>

                            <?php 
                          $co = mysqli_query($koneksi,"select * from nilai_pendidikan where nilai_pendidikan.id_alternatif='$data[id_alternatif]'");
                          while ($iy = mysqli_fetch_array($co)) {
                            ?> 
                            <td> <span class="badge badge-success">(<?php echo $iy['nilai_pendidikan'] ?>)</span></td>
                             <?php
                          }
                           ?>

                           <td>
              <a href="?page=edit-nilai&kode=<?php echo $data['id_alternatif']; ?>" title="Ubah"
               class="btn btn-success btn-sm">
                <i class="fa fa-edit"></i>
              </a>
              <a href="?page=del-nilai&kode=<?php echo $data['id_alternatif']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
               title="Hapus" class="btn btn-danger btn-sm">
                <i class="fa fa-trash"></i>
                </></td>
                           
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