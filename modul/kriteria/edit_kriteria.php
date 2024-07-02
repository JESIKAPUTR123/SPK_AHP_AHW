<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM kriteria WHERE id_kriteria='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>

<div class="card card-success">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Ubah Data kriteria</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<input type='hidden' class="form-control" name="id_kriteria" value="<?php echo $data_cek['id_kriteria']; ?>"
			 readonly/>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama kriteria</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" value="<?php echo $data_cek['nama_kriteria']; ?>"
					/>
				</div>
			</div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Jenis</label>
        <div class="col-sm-6">
          <input type="radio" name="jenis" value="Cost" <?php if($data_cek['jenis']=='Cost'){echo"checked";}else{} ?>> Cost
          <input type="radio" name="jenis" value="Benefit" <?php if($data_cek['jenis']=='Benefit'){echo"checked";}else{} ?>> Benefit
        </div>
      </div>

			

			

		

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="?page=data-kriteria" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>



<?php

    if (isset ($_POST['Ubah'])){
    $sql_ubah = "UPDATE kriteria SET
        nama_kriteria='".$_POST['nama_kriteria']."',
        jenis='".$_POST['jenis']."'
        WHERE id_kriteria='".$_POST['id_kriteria']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-kriteria';
        }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-kriteria';
        }
      })</script>";
    }}
?>
