<?php
	include "../inc/koneksi.php";
	
	if (isset ($_POST['Cetak'])){
	$id = $_POST['id_tidak'];
	}

	$tanggal = date("m/y");
	$tgl = date("d/m/y");
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>CETAK SURAT</title>
</head>

<body>
	<center>

	<?php include"cop_atas.php"; ?>

		<?php
			$sql_tampil = "select * from tb_pdd,tb_tidak_mampu 
			where tb_pdd.id_pend=tb_tidak_mampu.id_pdd and tb_tidak_mampu.id_tidak ='$id'";
			
			$query_tampil = mysqli_query($koneksi, $sql_tampil);
			$no=1;
			while ($data = mysqli_fetch_array($query_tampil,MYSQLI_BOTH)) {
		?>
	</center>

	<center>
		<h4>
			<u>SURAT KETARANGAN TIDAK MAMPU</u>
		</h4>
		<h4>No Surat :
			<?php echo $data['no_surat'] ?>
		</h4>
	</center>
		<p>Yang bertanda tangan di bawah ini Peratin Pekon Kota Agung, Kecataman Sungkai Selatan, Kabupaten Lampung Utara, Lampung. Menerangkan dengan Sesungguhnya bahwa :</P>
	<table>
		<tbody>

			<tr>
				<td>Nama</td>
				<td>:</td>
				<td>
					<?php echo $data['nama']; ?>
				</td>
			</tr>
			<tr>
				<td>Tempat, Tanggal lahir</td>
				<td>:</td>
				<td>
					<?php echo $data['tempat_lh']; ?>, <?php echo $data['tgl_lh']; ?>
				</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td>
					<?php  if($data['jekel']=='LK'){echo"Laki-laki";}else{echo"Perempuan";} ?>
				</td>
			</tr>
			<tr>
				<td>Agama</td>
				<td>:</td>
				<td>
					Islam
				</td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td>:</td>
				<td>
					<?php echo $data['pekerjaan']; ?>
				</td>
			</tr>
			<tr>
				<td>Status Perkawinan</td>
				<td>:</td>
				<td>
					<?php echo $data['kawin']; ?>
				</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td>
					<?php echo $data['desa']; ?> RT <?php echo $data['rt']; ?>, RW <?php echo $data['rw']; ?>
				</td>
			</tr>
			
			
			<?php } ?>
		</tbody>
	</table>
	<p>Bahwa yang namanya tersebut diatas adalah benar Warga Kota Agung, Kecataman Sungkai Selatan, Kabupaten Lampung Utara, Lampung, berdasarkan catatan kami dan ditinjau dari segi Ekonominya yang bersangkutan benar-benar tergolong  <b>Keluarga Miskin / Tidak Mampu.</b></P>
	<p>Demikian Surat Keterangan Tidak Mampu ini dibuat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.</P>
	<br>
	<br>
	<br>
	<br>
	<br>
<?php include"cop_bawah.php"; ?>


	<script>
		window.print();
	</script>

</body>

</html>