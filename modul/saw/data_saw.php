<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
      <?php 
      $rw = mysqli_fetch_array(mysqli_query($koneksi,"select * from rw where id_rw='$_GET[kode]'"));
       ?>
			<i class="fa fa-cogs"></i> Data Perhitungan SAW RW <?php echo $rw['nama_rw'] ?></h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
	
		
		
			<center><b>Nilai Awal</b></center>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					 <tr>
                        <th>No</th>
                        <th>Nama Alternatif</th>
                        <?php 
                        $sq = mysqli_query($koneksi,"select * from kriteria where nama_kriteria!='Pendidikan'");
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

                     
                       
                      </tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
              $sql = $koneksi->query("select * from nilai,alternatif where nilai.id_alternatif=alternatif.id_alternatif and alternatif.id_rw='$_GET[kode]' group by nilai.id_alternatif");
              while ($data= $sql->fetch_assoc()) {
            ?>

					<tr>
                          <td><?php echo $no++ ?></td>
                          <td><?php echo $data['nama'] ?></td>
                          <?php 
                          $coba = mysqli_query($koneksi,"select * from kriteria,nilai,sub where kriteria.id_kriteria=sub.id_kriteria and nilai.id_sub=sub.id_sub and nilai.id_alternatif='$data[id_alternatif]'");
                          while ($iya = mysqli_fetch_array($coba)) {
                            ?> 
                            <td> <span class="badge badge-warning"><?php echo $iya['nilai'] ?></span></td>
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
                           
                        </tr>

					<?php
              }
            ?>
				</tbody>
				</tfoot>
			</table>
    </div>
			<br>

      <div class="table-responsive">
			<center><b>Normalisasi</b></center>

			<table id="example2" class="table table-bordered table-striped">
				<thead>
					 <tr>
                        <th>No</th>
                        <th>Nama Alternatif</th>
                        <?php 
                        $sq = mysqli_query($koneksi,"select * from kriteria where nama_kriteria!='Pendidikan'");
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



                     
                       
                      </tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
              $sql = $koneksi->query("select * from nilai,alternatif where nilai.id_alternatif=alternatif.id_alternatif and alternatif.id_rw='$_GET[kode]' group by nilai.id_alternatif");
              while ($data= $sql->fetch_assoc()) {
            ?>

					<tr>
                          <td><?php echo $no++ ?></td>
                          <td><?php echo $data['nama'] ?></td>
                          
                          <?php 
                          $kriteria = mysqli_query($koneksi,"select * from kriteria where nama_kriteria!='Pendidikan'");
                          while ($diri = mysqli_fetch_array($kriteria)) 
                          {
                            $pembagi = mysqli_query($koneksi,"select kriteria.nama_kriteria,MAX(sub.nilai)as max ,MIN(sub.nilai) as min from sub,nilai,kriteria where kriteria.id_kriteria=sub.id_kriteria and sub.id_sub=nilai.id_sub and kriteria.id_kriteria='$diri[id_kriteria]'");
                            $kamu = mysqli_fetch_array($pembagi);
                            
                            $coba = mysqli_query($koneksi,"select * from sub,nilai,kriteria where kriteria.id_kriteria=sub.id_kriteria and sub.id_sub=nilai.id_sub
                            and nilai.id_alternatif='$data[id_alternatif]' 
                            and kriteria.id_kriteria='$diri[id_kriteria]'");
                            $iya = mysqli_fetch_array($coba);
                            ?> 
                            <td>
                                <?php 
                                if ($iya['jenis']=='Benefit') {
                                  $atribut = $iya['nilai']/$kamu['max'];
                                }else{
                                  $atribut = $kamu['min']/$iya['nilai'];
                                }
                                echo round($atribut,2);
                                 ?>
                                

                            </td><?php
                          }


                          
                          ?>



                          <?php 
                          $pendidik = mysqli_query($koneksi,"select * from pendidikan");
                          while ($di = mysqli_fetch_array($pendidik)) 
                          {
                            $pem = mysqli_query($koneksi,"select MAX(nilai_pendidikan.nilai_pendidikan)as max,
                              MIN(nilai_pendidikan.nilai_pendidikan) as min from nilai_pendidikan 
                              where nilai_pendidikan.id_pendidikan='$di[id_pendidikan]'");
                            $ka = mysqli_fetch_array($pem);
                            
                            $co = mysqli_query($koneksi,"select * from nilai_pendidikan,pendidikan where pendidikan.id_pendidikan=nilai_pendidikan.id_pendidikan and nilai_pendidikan.id_alternatif='$data[id_alternatif]' 
                            and nilai_pendidikan.id_pendidikan='$di[id_pendidikan]'");
                            $iy = mysqli_fetch_array($co);
                            ?> 
                            <td>
                                <?php 
                                if ($iy['jenis_pendidikan']=='Benefit') {
                                  $atr = $iy['nilai_pendidikan']/$ka['max'];
                                }else{
                                  $atr = $ka['min']/$iy['nilai_pendidikan'];
                                }
                                echo round($atr,2);
                                 ?>
                                

                            </td><?php
                          }


                          
                          ?>
                             
                        </tr>

					<?php
              }
            ?>
				</tbody>
				</tfoot>
			</table>
    </div>

      <br>

      <div class="table-responsive">
      <center><b>Normalisasi Terbobot</b></center>

      <table id="example4" class="table table-bordered table-striped">
        <thead>
           <tr>
                        <th>No</th>
                        <th>Nama Alternatif</th>
                        <?php 
                        $sq = mysqli_query($koneksi,"select * from kriteria where nama_kriteria!='Pendidikan'");
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
                         <th>Total</th>

                     
                       
                      </tr>
        </thead>
        <tbody>

          <?php
              $no = 1;
              $sql = $koneksi->query("select * from nilai,alternatif where nilai.id_alternatif=alternatif.id_alternatif and alternatif.id_rw='$_GET[kode]' group by nilai.id_alternatif");
              while ($data= $sql->fetch_assoc()) {
            ?>

          <tr>
                          <td><?php echo $no++ ?></td>
                          <td><?php echo $data['nama'] ?></td>
                          
                          <?php 
                          $kriteria = mysqli_query($koneksi,"select * from kriteria where nama_kriteria!='Pendidikan'");
                          $totalNilaiKriteria = 0;
                          $totalNilaiPendidikan = 0;
                          while ($diri = mysqli_fetch_array($kriteria)) 
                          {
                            $pembagi = mysqli_query($koneksi,"select kriteria.nama_kriteria,MAX(sub.nilai)as max ,MIN(sub.nilai) as min from sub,nilai,kriteria where kriteria.id_kriteria=sub.id_kriteria and sub.id_sub=nilai.id_sub and kriteria.id_kriteria='$diri[id_kriteria]'");
                            $kamu = mysqli_fetch_array($pembagi);
                            
                            $coba = mysqli_query($koneksi,"select * from sub,nilai,kriteria where kriteria.id_kriteria=sub.id_kriteria and sub.id_sub=nilai.id_sub
                            and nilai.id_alternatif='$data[id_alternatif]' 
                            and kriteria.id_kriteria='$diri[id_kriteria]'");
                            $iya = mysqli_fetch_array($coba);
                            ?> 
                            <td>
                                <?php 
                                if ($iya['jenis']=='Benefit') {
                                  $atribut = $iya['nilai']/$kamu['max'];
                                }else{
                                  $atribut = $kamu['min']/$iya['nilai'];
                                }
                                $matrik = $atribut * $iya['bobot'];
                                echo round($matrik,2);
                                 ?>
                                

                            </td><?php
                            $totalNilaiKriteria += $matrik;
                          }


                          
                          ?>


                          <?php 
                          $pendidik = mysqli_query($koneksi,"select * from pendidikan");
                          while ($di = mysqli_fetch_array($pendidik)) 
                          {
                            $pem = mysqli_query($koneksi,"select MAX(nilai_pendidikan.nilai_pendidikan)as max,
                              MIN(nilai_pendidikan.nilai_pendidikan) as min from nilai_pendidikan 
                              where nilai_pendidikan.id_pendidikan='$di[id_pendidikan]'");
                            $ka = mysqli_fetch_array($pem);
                            
                            $co = mysqli_query($koneksi,"select * from nilai_pendidikan,pendidikan where pendidikan.id_pendidikan=nilai_pendidikan.id_pendidikan and nilai_pendidikan.id_alternatif='$data[id_alternatif]' 
                            and nilai_pendidikan.id_pendidikan='$di[id_pendidikan]'");
                            $iy = mysqli_fetch_array($co);
                            ?> 
                            <td>
                                <?php 
                                if ($iy['jenis_pendidikan']=='Benefit') {
                                  $atr = $iy['nilai_pendidikan']/$ka['max'];
                                }else{
                                  $atr = $ka['min']/$iy['nilai_pendidikan'];
                                }
                                $ma = $atr * $iy['bobot'];

                                $ce = mysqli_fetch_array(mysqli_query($koneksi,"select * from kriteria where nama_kriteria='Pendidikan'"));
                                $bot = $ce['bobot'];
                                $mat = $ma/$bot;
                                echo round($mat,2);
                                 ?>
                                

                            </td><?php
                            $totalNilaiPendidikan += $mat;
                          }


                          
                          ?>
                          <td><?php $totalNilai = $totalNilaiKriteria+$totalNilaiPendidikan; echo round($totalNilai,2) ?></td>
                             
                        </tr>

          <?php
              }
            ?>
        </tbody>
        </tfoot>
      </table>
    </div>

			<center><b>Perankingan</b></center>

			 <table id="example5" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Rank</th>
                      <th>Nama</th>
                      <th>Total</th> 
                      <th>Keterangan</th>           
                    </tr>
                  </thead>
                  <tbody>
                   
                    <?php
 function getNama($id){
  $q =mysqli_query($koneksi,"SELECT * FROM alternatif where id = '$id' and alternatif.id_rw='$_GET[kode]' order by id_alternatif asc");
  $d = mysqli_fetch_array($q);
  return $d['nama'];
 }
                    
                    $hasil = mysqli_query($koneksi,"select * from alternatif,nilai,sub where sub.id_sub=nilai.id_sub and alternatif.id_alternatif=nilai.id_alternatif and alternatif.id_rw='$_GET[kode]' group by nilai.id_alternatif order by alternatif.id_alternatif asc");
                    $no = 1;
                    while ($dataku = mysqli_fetch_array($hasil)) 
                    {
                          
                    
                          $kriteria = mysqli_query($koneksi,"select * from kriteria where nama_kriteria!='Pendidikan'");
                          $totalNilaiKriteria = 0;
                          $totalNilaiPendidikan = 0;
                          while ($diri = mysqli_fetch_array($kriteria)) 
                          {
                            $pembagi = mysqli_query($koneksi,"select kriteria.nama_kriteria,MAX(sub.nilai)as max ,MIN(sub.nilai) as min from sub,nilai,kriteria where kriteria.id_kriteria=sub.id_kriteria and sub.id_sub=nilai.id_sub and kriteria.id_kriteria='$diri[id_kriteria]'");
                            $kamu = mysqli_fetch_array($pembagi);
                            
                            $coba = mysqli_query($koneksi,"select * from sub,nilai,kriteria where kriteria.id_kriteria=sub.id_kriteria and sub.id_sub=nilai.id_sub
                            and nilai.id_alternatif='$dataku[id_alternatif]' 
                            and kriteria.id_kriteria='$diri[id_kriteria]'");
                            $iya = mysqli_fetch_array($coba);
                            ?> 
                            
                                <?php 
                                if ($iya['jenis']=='Benefit') {
                                  $atribut = $iya['nilai']/$kamu['max'];
                                }else{
                                  $atribut = $kamu['min']/$iya['nilai'];
                                }
                                $matrik = $atribut * $iya['bobot'];
                               
                                 ?>
                                

                            <?php
                            $totalNilaiKriteria += $matrik;
                          }


                          $pendidik = mysqli_query($koneksi,"select * from pendidikan");
                          while ($di = mysqli_fetch_array($pendidik)) 
                          {
                            $pem = mysqli_query($koneksi,"select MAX(nilai_pendidikan.nilai_pendidikan)as max,
                              MIN(nilai_pendidikan.nilai_pendidikan) as min from nilai_pendidikan 
                              where nilai_pendidikan.id_pendidikan='$di[id_pendidikan]'");
                            $ka = mysqli_fetch_array($pem);
                            
                            $co = mysqli_query($koneksi,"select * from nilai_pendidikan,pendidikan where pendidikan.id_pendidikan=nilai_pendidikan.id_pendidikan and nilai_pendidikan.id_alternatif='$dataku[id_alternatif]' 
                            and nilai_pendidikan.id_pendidikan='$di[id_pendidikan]'");
                            $iy = mysqli_fetch_array($co);
                            ?> 
                            
                                <?php 
                                if ($iy['jenis_pendidikan']=='Benefit') {
                                  $atr = $iy['nilai_pendidikan']/$ka['max'];
                                }else{
                                  $atr = $ka['min']/$iy['nilai_pendidikan'];
                                }
                                $ma = $atr * $iy['bobot'];

                                $ce = mysqli_fetch_array(mysqli_query($koneksi,"select * from kriteria where nama_kriteria='Pendidikan'"));
                                $bot = $ce['bobot'];
                                $mat = $ma/$bot;
                                 ?>
                                

                            <?php
                            $totalNilaiPendidikan += $mat;
                          }


                          
                          

                          $totalNilai = $totalNilaiKriteria+$totalNilaiPendidikan;
                          
                     

                          
                         
                            $data[]=
                          array(
                            'nama'=>$dataku['nama'],
                                    'jumlah'=>$totalNilai);

                      }

                        
                    
      

                     
foreach ($data as $key => $isi) 
   {
    $nama[$key]=$isi['nama'];
    $jlh[$key]=$isi['jumlah'];
   }
   array_multisort($jlh,SORT_DESC,$data);
   $no=1;
foreach ($data as $item) 
  { ?>
   <tr>
   <td><?php echo $no++ ?></td>
   <td><?php echo$item['nama'] ?></td>
   <td> <span class="badge badge-dark"><?php echo round($item['jumlah'],2) ?></span></td>
  <td>
    <?php 
    if($no<='51'){
      ?> <span class="badge badge-success">Direkomendasikan</span> <?php
    }else{
      ?> <span class="badge badge-danger">Tidak Direkomendasikan</span> <?php
    }
     ?>
  </td>
   </tr>
   <?php
  }
  

                    ?> 
                    

             
                  </tbody>
                </table>


                <a href="hasil_excel.php?kode=<?php echo $_GET[kode] ?>" target="_blank"><button class="btn btn-success"><i class="fa fa-file-excel-o"></i> Download Excel</button></a>
                <a href="hasil_pdf.php?kode=<?php echo $_GET[kode] ?>" target="_blank"><button class="btn btn-primary"><i class="fa fa-file"></i> Print PDF</button></a>
		</div>
	</div>
	<!-- /.card-body -->