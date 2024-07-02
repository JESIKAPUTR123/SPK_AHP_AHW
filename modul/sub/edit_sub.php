<?php

    if(isset($_GET['kode'])){
        $sql_cek = "select * from sub,kriteria where sub.id_kriteria=kriteria.id_kriteria and sub.id_sub='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>

<div class="card card-success">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Ubah Data Sub kriteria</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<input type='hidden' class="form-control" name="id_sub" value="<?php echo $data_cek['id_sub']; ?>"
			 readonly/>

			
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Kriteria</label>
        <div class="col-sm-6">
          <select name="kriteria" class="form-control" required="">
            <option value="">-Pilih Kriteria-</option>
            <?php 
            $s = mysqli_query($koneksi,"select * from kriteria");
            while($d = mysqli_fetch_array($s)){
              ?> <option value="<?php echo $d['id_kriteria'] ?>" <?php if($d['id_kriteria']==$data_cek['id_kriteria']){echo"selected";}else{} ?>><?php echo $d['nama_kriteria'] ?></option> <?php
            }
             ?>
            
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Sub kriteria</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" value="<?php echo $data_cek['nama_sub']; ?>" id="nama_kriteria" name="sub" placeholder="Nama Sub Kriteria" required>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nilai</label>
        <div class="col-sm-6">
          <input type="number" class="form-control" value="<?php echo $data_cek['nilai']; ?>" id="nilai" name="nilai" placeholder="Nilai" required>
        </div>
      </div>

			

			

		

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="?page=data-sub" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>



<?php

    if (isset ($_POST['Ubah'])){
    $sql_ubah = "UPDATE sub SET
        id_kriteria='".$_POST['kriteria']."',
        nama_sub='".$_POST['sub']."',
        nilai='".$_POST['nilai']."'
        WHERE id_sub='".$_POST['id_sub']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-sub';
        }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-sub';
        }
      })</script>";
    }}
?>
