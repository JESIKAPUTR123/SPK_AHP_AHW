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
			$sql_tampil = "select * from tb_pdd,tb_izin
			where tb_pdd.id_pend=tb_izin.id_pdd and tb_izin.id_pdd ='$id'";
			
			$query_tampil = mysqli_query($koneksi, $sql_tampil);
			$no=1;
			while ($data = mysqli_fetch_array($query_tampil,MYSQLI_BOTH)) {
		?>
	</center>

	<center>
		<h4>
			<u>SURAT KETARANGAN IZIN KERAMAIAN</u>
		</h4>
		<h4>No Surat :
			<?php echo $data['no_surat'] ?>
		</h4>
	</center>
		<p>Yang bertanda tangan dibawah ini Plt. Peratin Pekon Kota Agung, Kecataman Sungkai Selatan, Kabupaten Lampung Utara, Lampung dengan ini mengajukan Permohonan Kepada Bapak Kapolsek Sungkai Selatan, besar harapan kami kiranya Bapak dapat mengeluarkan izin keramaian atas nama tersebut dibawah ini :</P>
	<table>
		<tbody>
			<tr>
				<td>NIK</td>
				<td>:</td>
				<td>
					<?php echo $data['nik']; ?>
				</td>
			</tr>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td>
					<?php echo $data['nama']; ?>
				</td>
			</tr>
			<tr>
				<td>TTL</td>
				<td>:</td>
				<td>
					<?php echo $data['tempat_lh']; ?>/
					<?php echo $data['tgl_lh']; ?>
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
	<p>Warga tersebut diatas bermaksud akan mengadakan <?php echo $data['nama_acara']; ?>, adapun rencana <?php echo $data['nama_acara']; ?> akan dilaksanakan pada :</p>
	<table>
			<tr>
				<td>Tanggal Acara</td>
				<td>:</td>
				<td>
					<?php echo $data['tgl_acara']; ?>
				</td>
			</tr>
			<tr>
				<td>Waktu</td>
				<td>:</td>
				<td>08.00 WIB s.d Selesai</td>
			</tr>
			<tr>
				<td>Tempat</td>
				<td>:</td>
				<td>
					<?php echo $data['lokasi']; ?>
				</td>
			</tr>

			
			<tr>
				<td>Hiburan</td>
				<td>:</td>
				<td>
					<?php echo $data['hiburan']; ?>
				</td>
			</tr>

				<?php } ?>
		</tbody>
	</table>
	<p>Demikianlah permohonan ini kami buat dengan sebenarnya sesuai dengan permohonan yang bersangkutan dan atas bantuannya diucapkan terimakasih.</P>
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