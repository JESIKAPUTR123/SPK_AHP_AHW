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
			$sql_tampil = "select * from tb_pdd,tb_hilang
			where tb_pdd.id_pend=tb_hilang.id_pdd and tb_hilang.id_pdd ='$id'";
			
			$query_tampil = mysqli_query($koneksi, $sql_tampil);
			$no=1;
			$data = mysqli_fetch_array($query_tampil);
		?>
	</center>

	<center>
		<h4>
			<u>SURAT KETERANGAN KEHILANGAN</u>
		</h4>
		<h4>No Surat :
			<?php echo $data['no_surat'] ?>
		</h4>

	</center>
		<p>Yang bertanda tangan dibawah ini Peratin Desa Kota Agung, Kecataman Sungkai Selatan, Kabupaten Lampung Utara, Lampung, dengan ini menerangkan bahwa :</P>
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
				<td>Usia</td>
				<td>:</td>
				<td>
					<?php 
					function hitung_umur($tanggal_lahir){
	$birthDate = new DateTime($tanggal_lahir);
	$today = new DateTime("today");
	if ($birthDate > $today) { 
	    exit("0 tahun");
	}
	$y = $today->diff($birthDate)->y;
	$m = $today->diff($birthDate)->m;
	$d = $today->diff($birthDate)->d;
	return $y." tahun ";
}

echo hitung_umur($data['tgl_lh']);
					 ?>
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
				<td>Alamat</td>
				<td>:</td>
				<td>
					<?php echo $data['desa']; ?>
				</td>
			</tr>
			
		
		
		</tbody>
	</table>

	<p>
		Bahwa yang bersangkutan diatas melaporka telah kehilangan Barang/Surat berharga, yaitu berupa:
	</p>

	<ol>
		<li><?php echo $data['b1'] ?></li>
		<li><?php echo $data['b2'] ?></li>
		<li><?php echo $data['b3'] ?></li>
		<li><?php echo $data['b4'] ?></li>
		<li><?php echo $data['b5'] ?></li>
	</ol>

	<p>
		Barang/Surat tersebut hilang pada <?php echo $data['tgl_hilang'] ?> dan diperkirakan hilang di <?php echo $data['lokasi'] ?>
	</p>

	<p>Demikian surat keterangan ini kami buat dengan sebenarnya, dan untuk dipergunakan sebagaimana mestinya.</P>
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