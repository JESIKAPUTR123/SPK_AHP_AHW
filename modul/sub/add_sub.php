<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data Sub Kriteria</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Kriteria</label>
        <div class="col-sm-6">
          <select name="kriteria" class="form-control" required="">
            <option value="">-Pilih Kriteria-</option>
            <?php 
            $s = mysqli_query($koneksi,"select * from kriteria");
            while($d = mysqli_fetch_array($s)){
              ?> <option value="<?php echo $d['id_kriteria'] ?>"><?php echo $d['nama_kriteria'] ?></option> <?php
            }
             ?>
            
          </select>
        </div>
      </div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Sub kriteria</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_kriteria" name="sub" placeholder="Nama Sub Kriteria" required>
				</div>
			</div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nilai</label>
        <div class="col-sm-6">
          <input type="number" class="form-control" id="nilai" name="nilai" placeholder="Nilai" required>
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
        $sql_simpan = "INSERT INTO sub (id_kriteria,nama_sub,nilai) VALUES (
        '".$_POST['kriteria']."','".$_POST['sub']."','".$_POST['nilai']."')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data-sub';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-sub';
          }
      })</script>";
    }}
     //selesai proses simpan data
