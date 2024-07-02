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
			<u>LAPORAN SURAT KETARANGAN KEMATIAN</u><br>
			Periode <?php echo $_POST['dari'] ?> sampai <?php echo $_POST['sampai'] ?>
		</h4>
		
		<table width="100%" border='1'>
				<thead>
					<tr>
						<th>No</th>
						<th>NIK</th>
						<th>Nama</th>
						<th>Tanggal</th>
						<th>Sebab</th>
					</tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
			  $sql = $koneksi->query("select * from tb_mendu,tb_pdd where tb_mendu.id_pdd=tb_pdd.id_pend and tb_mendu.tgl_mendu between '$_POST[dari]' and '$_POST[sampai]'");
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
							<?php echo $data['nama']; ?>
						</td>
						<td>
							<?php echo $data['tgl_mendu']; ?>
						</td>
						<td>
							<?php echo $data['sebab']; ?>
						</td>
					</tr>

					<?php
              }
            ?>
				</tbody>
				</tfoot>
			</table>
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