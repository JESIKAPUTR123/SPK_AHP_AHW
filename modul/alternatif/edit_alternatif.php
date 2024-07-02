<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM alternatif,rw WHERE alternatif.id_rw=rw.id_rw and alternatif.id_alternatif='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>

<div class="card card-success">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Ubah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<input type='hidden' class="form-control" name="id_alternatif" value="<?php echo $data_cek['id_alternatif']; ?>"
			 readonly/>

			

			<div class="form-group row">
                <label class="col-sm-2 col-form-label">No KK</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" id="username" value="<?php echo $data_cek['no_kk']; ?>" name="no_kk" placeholder="Nomor Kartu Keluarga">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Rukun Warga</label>
                <div class="col-sm-6">
                    <select name="rw" class="form-control" required="">
                        <?php 
                        $s = mysqli_query($koneksi,"select * from rw");
                        while($d = mysqli_fetch_array($s)){
                            ?> <option value="<?php echo $d['id_rw'] ?>" <?php if($d['id_rw']==$data_cek['id_rw']){echo"selected";}else{} ?>><?php echo $d['nama_rw'] ?></option> <?php
                        }
                         ?>
                        
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">NIK</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" value="<?php echo $data_cek['nik']; ?>" id="username" name="nik" placeholder="Nomor Induk Kependudukan">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Warga</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="nama_alternatif" value="<?php echo $data_cek['nama']; ?>" name="nama" placeholder="Nama Alternatif" required>
                </div>
            </div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="?page=data-alternatif" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>



<?php

    if (isset ($_POST['Ubah'])){
    $sql_ubah = "UPDATE alternatif SET
        nama='".$_POST['nama']."',
        no_kk='".$_POST['no_kk']."',
        nik='".$_POST['nik']."',
        id_rw='".$_POST['rw']."'
        WHERE id_alternatif='".$_POST['id_alternatif']."'";
    $query_ubah = mysqli_query($koneksi, $sql_ubah);
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-alternatif';
        }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-alternatif';
        }
      })</script>";
    }}
?>

<script type="text/javascript">
    function change()
    {
    var x = document.getElementById('pass').type;

    if (x == 'password')
    {
        document.getElementById('pass').type = 'text';
        document.getElementById('mybutton').innerHTML;
    }
    else
    {
        document.getElementById('pass').type = 'password';
        document.getElementById('mybutton').innerHTML;
    }
    }
</script>