<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data Penilaian</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

		


       <div class="form-group row">
                        <label class="exampleInputEmail1">Nama Alternatif:</label>
                        
                            <select name="nama" class="form-control" required="">
                              <option value="">-Pilih Alternatif-</option>
                              <?php 

                              $ee = mysqli_query($koneksi,"select * from alternatif");
                              while ($oy = mysqli_fetch_array($ee)) {
                                ?> <option value="<?php echo $oy['id_alternatif'] ?>"><?php echo $oy['nama'] ?></option> <?php
                              }
                               ?>
                            </select>
                       
                    </div>

                    <?php 
                    $sq = mysqli_query($koneksi,"select * from kriteria where nama_kriteria!='Pendidikan'");
                    while ($da = mysqli_fetch_array($sq)) {
                      ?> 
                      <div class="form-group row">
                        <label class="exampleInputEmail1"><?php echo $da['nama_kriteria'] ?>:</label>
                       
                            <select name='kriteria[]' data-placeholder="Pilih <?php echo $da['nama_kriteria'] ?>..." class="form-control" required="">
                                <option value="">-Pilih <?php echo $da['nama_kriteria'] ?>-</option>";
                                <?php
                                $query = "SELECT * FROM sub where id_kriteria='$da[id_kriteria]' order by id_sub asc";
                                $hasil = mysqli_query($koneksi,$query);
                                while ($data = mysqli_fetch_array($hasil)) 
                                {
                                    echo "<option value='".$data['id_sub']."'>".$data['nama_sub']."</option>";
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
                      <div class="form-group row">
                        <label class="exampleInputEmail1"><?php echo $d['nama_pendidikan'] ?>:</label>
                       <input type="hidden" name="pendidikan[]" class="form-control" value="<?php echo $d['id_pendidikan'] ?>">
                            <input type="number" name="nilai[]" class="form-control">
                        
                    </div>
                       <?php
                    }
                     ?>

		

		

		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=data-nilai" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php

    if (isset ($_POST['Simpan'])){

      $cek = mysqli_query($koneksi,"select * from nilai where id_alternatif='$_POST[nama]'");
        $dat = mysqli_num_rows($cek);
        if ($dat >0) {
          echo "<script>
      Swal.fire({title: 'Data Sudah Ada',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-nilai';
          }
      })</script>";
        }else{
          //mulai proses simpan data
          $kriteria = $_POST['kriteria'];
              foreach ($kriteria as $row) {
                $query_simpan =  mysqli_query($koneksi,"INSERT INTO nilai VALUES (null,'$_POST[nama]','$row')");
              }

              $n = count($_POST['pendidikan']);
          for($ii=0; $ii < $n ; $ii++){
            $pendidikan = $_POST['pendidikan'][$ii];
            $nilai = $_POST['nilai'][$ii];
            
             mysqli_query($koneksi,"INSERT INTO nilai_pendidikan 
                  VALUES (null,'$_POST[nama]','$pendidikan','$nilai')");
            
            
          }

             
       
        mysqli_close($koneksi);

    if ($query_simpan) {
      echo "<script>
      Swal.fire({title: 'Tambah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=data-nilai';
          }
      })</script>";
      }else{
      echo "<script>
      Swal.fire({title: 'Tambah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value){
          window.location = 'index.php?page=add-nilai';
          }
      })</script>";
    }
        }


    





  }
     //selesai proses simpan data
