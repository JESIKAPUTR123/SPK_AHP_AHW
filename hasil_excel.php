<!DOCTYPE html>
<html>
<?php
error_reporting(0);
?>
<head>
	<title>Hasil Excel</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;
 
	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>
 
	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Hasil.xls");
	?>
 <?php include"inc/koneksi.php"; ?>
  <?php 
      $rw = mysqli_fetch_array(mysqli_query($koneksi,"select * from rw where id_rw='$_GET[kode]'"));
       ?>
	<center><b>Desa Way Huwi RW <?php echo $rw['nama_rw'] ?></b></center>

     <table width="100%" border="1">
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
                    
                    $hasil = mysqli_query($koneksi,"select * from alternatif,nilai,sub where sub.id_sub=nilai.id_sub and alternatif.id_alternatif=nilai.id_alternatif group by nilai.id_alternatif order by alternatif.id_alternatif asc");
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
</body>
</html>