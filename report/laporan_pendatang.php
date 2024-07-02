<?php
	include "../inc/koneksi.php";
	

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>CETAK SURAT</title>
</head>

<body>
	<?php include"cop_atas.php"; ?>

	<center>
		<h4>
			<u>LAPORAN SURAT PENDATANG</u><br>
			Periode <?php echo $_POST['dari'] ?> sampai <?php echo $_POST['sampai'] ?>
		</h4>
		
		<table width="100%" border='1'>
				<thead>
					<tr>
						<th>No</th>
						<th>NIK</th>
						<th>Nama</th>
						<th>Jekel</th>
						<th>Tanggal</th>
						<th>Pelapor</th>
					</tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
			  $sql = $koneksi->query("SELECT * from tb_datang,tb_pdd where tb_datang.pelapor=tb_pdd.id_pend and tb_datang.tgl_datang between '$_POST[dari]' and '$_POST[sampai]'");
              while ($data= $sql->fetch_assoc()) {
            	?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['nik']; ?>
						</td>
						<td>
							<?php echo $data['nama_datang']; ?>
						</td>
						<td>
							<?php echo $data['jekel']; ?>
						</td>
						<td>
							<?php echo $data['tgl_datang']; ?>
						</td>
						<td>
							<?php echo $data['nama']; ?>
						</td>
					</tr>

					<?php
              }
            ?>
				</tbody>
				</tfoot>
			</table>
	
	<br>
	<br>
	<br>
	<?php include"cop_bawah.php"; ?>


	<script>
		window.print();
	</script>

</body>

</html>