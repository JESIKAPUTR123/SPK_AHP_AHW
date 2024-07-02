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
			<u>LAPORAN SURAT KETARANGAN KELAHIRAN</u><br>
			Periode <?php echo $_POST['dari'] ?> sampai <?php echo $_POST['sampai'] ?>
		</h4>
		
		<table width="100%" border='1'>
				<thead>
					<tr>
						<th>No</th>
						<th>Nama</th>
						<th>Tgl Lahir</th>
						<th>Jekel</th>
						<th>Keluarga</th>
					</tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
			  $sql = $koneksi->query("SELECT * from tb_lahir,tb_kk where tb_lahir.id_kk=tb_kk.id_kk and tb_lahir.tgl_lh between '$_POST[dari]' and '$_POST[sampai]'");
              while ($data= $sql->fetch_assoc()) {
            ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['nama']; ?>
						</td>
						<td>
							<?php echo $data['tgl_lh']; ?>
						</td>
						<td>
							<?php echo $data['jekel']; ?>
						</td>
						<td>
							<?php echo $data['no_kk']; ?>-
							<?php echo $data['kepala']; ?>
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
	<br>
	<?php include"cop_bawah.php"; ?>


	<script>
		window.print();
	</script>

</body>

</html>