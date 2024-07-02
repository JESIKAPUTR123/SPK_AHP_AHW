<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data kriteria</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama kriteria</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" placeholder="Nama kriteria" required>
				</div>
			</div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Jenis</label>
        <div class="col-sm-6">
          <input type="radio" name="jenis" value="Cost"> Cost
          <input type="radio" name="jenis" value="Benefit"> Benefit
        </div>
      </div>

		

		

		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=data-kriteria" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php

    if (isset ($_POST['Simpan'])){
    //mulai proses simpan data
        $sql_simpan = "INSERT INTO kriteria (nama_kriteria,jenis) VALUES (
        '".$_POST['nama_kriteria']."','".$_POST['jenis']."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data-kriteria';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-kriteria';
          }
      })</script>";
    }}
     //selesai proses simpan data
