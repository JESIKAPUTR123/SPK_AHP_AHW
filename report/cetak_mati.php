<?php
	include "../inc/koneksi.php";
	
	if (isset ($_POST['Cetak'])){
	$id = $_POST['id_mendu'];
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
			$sql_tampil = "SELECT * from tb_mendu,tb_pdd where tb_mendu.id_pdd=tb_pdd.id_pend and tb_mendu.id_mendu ='$id'";
			
			$query_tampil = mysqli_query($koneksi, $sql_tampil);
			$no=1;
			$data = mysqli_fetch_array($query_tampil);
		?>
	</center>

	<center>
		<h4>
			<u>SURAT KETARANGAN KEMATIAN</u>
		</h4>
		<h4>No Surat :
			<?php echo $data['no_surat'] ?>
		</h4>
	</center>
		<p>Yang bertanda tangan di bawah ini Peratin Pekon Kota Agung, Kecataman Sungkai Selatan, Kabupaten Lampung Utara, Lampung menerangkan dengan sebenarnya bahwa :</P>
	<table>
		<tbody>
			
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td>
					<?php echo $data['nama_md']; ?>
				</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td>
					<?php echo $data['jk_md']; ?>
				</td>
			</tr>
			<tr>
				<td>Tempat & Tanggal Lahir</td>
				<td>:</td>
				<td>
					<?php echo $data['tempat_lahir_md']; ?>, <?php echo $data['tgl_lahir_md'] ?>
				</td>
			</tr>
			<tr>
				<td>Agama</td>
				<td>:</td>
				<td>
					<?php echo $data['agama_md']; ?>
				</td>
			</tr>
			<tr>
				<td>Pekerjaan</td>
				<td>:</td>
				<td>
					<?php echo $data['pekerjaan_md']; ?>
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
				<td>Alamat</td>
				<td>:</td>
				<td>
					<?php echo $data['alamat_md']; ?>
				</td>
			</tr>


		
		</tbody>
	</table>
	<p>Telah Meninggal dunia Pada	:</p>
	<table>
		<tr>
				<td>Tanggal Kematian</td>
				<td>:</td>
				<td>
					<?php echo $data['tgl_mendu']; ?>
				</td>
			</tr>
			<tr>
				<td>Pukul</td>
				<td>:</td>
				<td>
					<?php echo $data['pukul']; ?>
				</td>
			</tr>
			<tr>
				<td>Meninggal Karena</td>
				<td>:</td>
				<td>
					<?php echo $data['sebab']; ?>
				</td>
			</tr>
			<tr>
				<td>Dimakamkan</td>
				<td>:</td>
				<td>
					<?php echo $data['makam']; ?>
				</td>
			</tr>
	</table>
	<p>Surat Keterangan ini dibuat berdasarkan keterangan pelapor :</p>
	<table>
		<tr>
				<td>Nama</td>
				<td>:</td>
				<td>
					<?php echo $data['nama']; ?>
				</td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td>
					<?php echo $data['jekel']; ?>
				</td>
			</tr>
			<tr>
				<td>Tempat & Tanggal Lahir</td>
				<td>:</td>
				<td>
					<?php echo $data['tempat_lh']; ?>, <?php echo $data['tgl_lh'] ?>
				</td>
			</tr>
			<tr>
				<td>Agama</td>
				<td>:</td>
				<td>
					<?php echo $data['agama']; ?>
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
				<td>NIK</td>
				<td>:</td>
				<td>
					<?php echo $data['nik']; ?>
				</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td>
					<?php echo $data['desa']; ?>
				</td>
			</tr>
	</table>
	<p>Hub. Dengan yang meninggal	: <?php echo $data['hub'] ?></p>

	<p>Demikian surat keterangan kematian ini dibuat dengan sebenarnya agar dapat dipergunakan sebagai mana mestinya..</P>
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