<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM alternatif WHERE id_alternatif='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>

<div class="card card-success">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Ubah Data Penilaian Alternatif</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<input type='hidden' class="form-control" name="id_alternatif" value="<?php echo $data_cek['id_alternatif']; ?>"
			 readonly/>

			<div class="form-group row">
                        <label class="exampleInputEmail1">Nama Alternatif:</label>
                        <br>
                            <?php echo $data_cek['nama'] ?>
                       
                    </div>

                    <?php 
                    $sq = mysqli_query($koneksi,"select * from kriteria");
                    while ($da = mysqli_fetch_array($sq)) {
                      ?> 

                      <?php 
                      $sql = mysqli_query($koneksi,"select * from nilai,sub,kriteria where nilai.id_sub=sub.id_sub and kriteria.id_kriteria=sub.id_kriteria and kriteria.id_kriteria='$da[id_kriteria]' 
                        and nilai.id_alternatif='$data_cek[id_alternatif]'");
                      $dat = mysqli_fetch_array($sql);
                       ?>
                      <div class="form-group row">
                        <label class="exampleInputEmail1"><?php echo $da['nama_kriteria'] ?>:</label>
                        <input type="hidden" name="nilai[]" value="<?php echo $dat['id_nilai'] ?>">
                        <input type="hidden" name="sub[]" value="<?php echo $dat['id_sub'] ?>">
                       
                            <select name='kriteria[]' data-placeholder="Pilih <?php echo $da['nama_kriteria'] ?>..." class="form-control" required="">
                                <option value="">-Pilih <?php echo $da['nama_kriteria'] ?>-</option>";
                                <?php
                                $query = "SELECT * FROM sub where id_kriteria='$da[id_kriteria]' order by id_sub asc";
                                $hasil = mysqli_query($koneksi,$query);
                                while ($data = mysqli_fetch_array($hasil)) 
                                {
                                    ?>"<option value='<?php echo $data['id_sub']?>'
                                      <?php if($data['id_sub']==$dat['id_sub']){echo"selected";}else{} ?>
                                      ><?php echo $data['nama_sub']?></option><?php
                                }
                                ?>
                            </select>
                        
                    </div>
                       <?php
                    }
                     ?>



                     <hr>
                     <b><center>Pendidikan</center></b>
                      <?php 
                    $s = mysqli_query($koneksi,"select * from pendidikan");
                    while ($d = mysqli_fetch_array($s)) {
                      ?> 

                      <?php 
                      $sql = mysqli_query($koneksi,"select * from nilai_pendidikan where nilai_pendidikan.id_pendidikan='$d[id_pendidikan]' 
                        and nilai_pendidikan.id_alternatif='$data_cek[id_alternatif]'");
                      $dat = mysqli_fetch_array($sql);
                       ?>
                      <div class="form-group row">
                        <label class="exampleInputEmail1"><?php echo $d['nama_pendidikan'] ?>:</label>
                       <input type="hidden" name="pendidikan[]" class="form-control" value="<?php echo $d['id_pendidikan'] ?>">
                            <input type="number" name="nilai_pendidikan[]" class="form-control" value="<?php echo $dat['nilai_pendidikan'] ?>">
                        <input type="hidden" name="id_nilai_pendidikan[]" value="<?php echo $dat['id_nilai_pendidikan'] ?>">
                    </div>
                       <?php
                    }
                     ?>

			

			

		

		</div>
		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="?page=data-kriteria" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>



<?php

    if (isset ($_POST['Ubah'])){
            foreach ($_POST['kriteria'] as $key => $val) {
                    $kriteria = ($_POST['kriteria'][$key]);
                    $nilai = ($_POST['nilai'][$key]);
                    $sub = ($_POST['sub'][$key]);
                   

                    mysqli_query($koneksi,"update nilai set 
                      id_sub='$kriteria' where id_nilai='$nilai'");
                  }

              $n = count($_POST['pendidikan']);
          for($ii=0; $ii < $n ; $ii++){
            $pendidikan = $_POST['pendidikan'][$ii];
            $nilai_pendidikan = $_POST['nilai_pendidikan'][$ii];
            $id_nilai_pendidikan = $_POST['id_nilai_pendidikan'][$ii];
            
             $query_ubah = mysqli_query($koneksi,"update nilai_pendidikan set nilai_pendidikan='$nilai_pendidikan' where id_nilai_pendidikan='$id_nilai_pendidikan'");
            
            
          }
    mysqli_close($koneksi);

    if ($query_ubah) {
        echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-nilai';
        }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
        {window.location = 'index.php?page=data-nilai';
        }
      })</script>";
    }}
?>
