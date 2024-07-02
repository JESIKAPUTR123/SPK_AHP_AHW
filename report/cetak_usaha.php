<?php
	include "../inc/koneksi.php";
	
	if (isset ($_POST['Cetak'])){
	$id = $_POST['id_pend'];
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
			$sql_tampil = "select * from tb_pdd,tb_usaha
			where tb_pdd.id_pend=tb_usaha.id_pdd and tb_usaha.id_pdd ='$id'";
			
			$query_tampil = mysqli_query($koneksi, $sql_tampil);
			$no=1;
			$data = mysqli_fetch_array($query_tampil);
		?>
	</center>

	<center>
		<h4>
			<u>SURAT KETARANGAN USAHA</u>
		</h4>
		<h4>No Surat :
			<?php echo $data['no_surat'] ?>
		</h4>

	</center>
		<p>Yang bertanda tangan di bawah ini Peratin Pekon Kota Agung, Kecataman Sungkai Selatan, Kabupaten Lampung Utara, Lampung dengan ini menerangkan dengan sesungguhnya bahwa :</P>
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
				<td>NIK</td>
				<td>:</td>
				<td>
					<?php echo $data['nik']; ?>
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
			
		
		
		</tbody>
	</table>
	<p>
		Yang tersebut di atas adalah benar warga Pekon Kota Agung, Kecataman Sungkai Selatan, Kabupaten Lampung Utara, Lampung, selama ini mempunyai Bidang Usaha di Bidang : <?php echo $data['bidang'] ?> Sejak Tahun <?php echo $data['tahun'] ?> Sampai dengan sekarang yang berlokasi di <?php echo $data['alamat'] ?>.
	</p>

	<p>Demikian Surat Keterangan Usaha ini kami buat dengan sebenar-benarnya agar dipergunakan sebagaimana mestinya.</P>
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