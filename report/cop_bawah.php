	<?php error_reporting(0) ?>
	<table width="100%">
		<tr>
			<td><center><br><br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<br><b><u></u></b></center>
			</td>
			<td><center>
				Lampung Utara,
		
		<?php $tgl = date("d/m/y");echo $tgl; ?>
		<br> Kepala Desa Kota Agung<br>
		<?php include"../phpqrcode/qrlib.php";
          QRcode::png("http//www.dumetschool.com", "image.png", "L", 4, 4);
          echo "<img src='image.png'>";
          ?>
		<br><b><u>Darus</u></b></center>
			</td>
		</tr>
	</table>
	