<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">No KK</label>
				<div class="col-sm-6">
					<input type="number" class="form-control" id="username" name="no_kk" placeholder="Nomor Kartu Keluarga">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Rukun Warga</label>
				<div class="col-sm-6">
					<select name="rw" class="form-control" required="">
						<option value="">-Pilih RW-</option>
						<?php 
						$s = mysqli_query($koneksi,"select * from rw");
						while($d = mysqli_fetch_array($s)){
							?> <option value="<?php echo $d['id_rw'] ?>"><?php echo $d['nama_rw'] ?></option> <?php
						}
						 ?>
						
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NIK</label>
				<div class="col-sm-6">
					<input type="number" class="form-control" id="username" name="nik" placeholder="Nomor Induk Kependudukan">
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Warga</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_alternatif" name="nama" placeholder="Nama Alternatif" required>
				</div>
			</div>

			


		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=data-alternatif" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php

    if (isset ($_POST['Simpan'])){
    //mulai proses simpan data
        $sql_simpan = "INSERT INTO `alternatif` (`id_alternatif`, `no_kk`, `nik`, `nama`, `id_rw`) 
        VALUES (NULL, '$_POST[no_kk]',
         '$_POST[nik]', '$_POST[nama]' , '$_POST[rw]');";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data-alternatif';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-alternatif';
          }
      })</script>";
    }}
     //selesai proses simpan data
