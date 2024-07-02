<?php	
// mencari ID pendidikan
// berdasarkan urutan ke berapa (C1, C2, C3)
function getPendidikanID($no_urut) {
	include('config.php');
	$query  = "SELECT id_pendidikan FROM pendidikan ORDER BY id_pendidikan";
	$result = mysqli_query($kon, $query);

	while ($row = mysqli_fetch_array($result)) {
		$listID[] = $row['id_pendidikan'];
	}

	return $listID[($no_urut)];
}
function getPendidikanIDI($no_urut) {
	include('config.php');
	$query  = "SELECT id_pendidikan FROM pendidikan ORDER BY id_pendidikan";
	$result = mysqli_query($kon, $query);

	while ($row = mysqli_fetch_array($result)) {
		$listID[] = $row['id_pendidikan'];
	}

	return $listID[($no_urut)];
}
// mencari nama pendidikan
function getPendidikanNama($no_urut) {
	include('config.php');
	$query  = "SELECT nama_pendidikan FROM pendidikan ORDER BY id_pendidikan";
	$result = mysqli_query($kon, $query);

	while ($row = mysqli_fetch_array($result)) {
		$nama[] = $row['nama_pendidikan'];
	}

	return $nama[($no_urut)];
}


// mencari nilai bobot perbandingan pendidikan
function getNilaiPerbandinganPendidikan($pendidikan1,$pendidikan2) {
	include('config.php');

	$id_pendidikan1 = getPendidikanID($pendidikan1);
	$id_pendidikan2 = getPendidikanID($pendidikan2);

	$query  = "SELECT nilai FROM perbandingan_pendidikan WHERE pendidikan1 = $id_pendidikan1 AND pendidikan2 = $id_pendidikan2";
	$result = mysqli_query($kon, $query);

	if (!$result) {
		echo "Error !!!";
		exit();
	}

	if (mysqli_num_rows($result)==0) {
		$nilai = 1;
	} else {
		while ($row = mysqli_fetch_array($result)) {
			$nilai = $row['nilai'];
		}
	}

	return $nilai;
}

// mencari jumlah pendidikan
function getJumlahPendidikan() {
	include('config.php');
	$query  = "SELECT count(*) FROM pendidikan";
	$result = mysqli_query($kon, $query);
	while ($row = mysqli_fetch_array($result)) {
		$jmlData = $row[0];
	}

	return $jmlData;
}	

// memasukkan bobot nilai perbandingan pendidikan
function inputDataPerbandinganPendidikan($pendidikan1,$pendidikan2,$nilai) {
	include('config.php');

	$id_pendidikan1 = getPendidikanIDI($pendidikan1);
	$id_pendidikan2 = getPendidikanIDI($pendidikan2);

	$query  = "SELECT * FROM perbandingan_pendidikan WHERE pendidikan1 = $id_pendidikan1 AND pendidikan2 = $id_pendidikan2";
	$result = mysqli_query($kon, $query);

	if (!$result) {
		echo "Error !!!";
		exit();
	}

	// jika result kosong maka masukkan data baru
	// jika telah ada maka diupdate
	if (mysqli_num_rows($result)==0) {
		$query = "INSERT INTO perbandingan_pendidikan (pendidikan1,pendidikan2,nilai) VALUES ($id_pendidikan1,$id_pendidikan2,$nilai)";
	} else {
		$query = "UPDATE perbandingan_pendidikan SET nilai=$nilai WHERE pendidikan1=$id_pendidikan1 AND pendidikan2=$id_pendidikan2";
	}

	$result = mysqli_query($kon, $query);
	if (!$result) {
		echo "Gagal memasukkan data perbandingan";
		exit();
	}

}


// memasukkan nilai priority vektor pendidikan
function inputPendidikanPV ($id_pendidikan,$pv) {
	include ('config.php');

	$query = "SELECT * FROM pv_pendidikan WHERE id_pendidikan=$id_pendidikan";
	$result = mysqli_query($kon, $query);

	if (!$result) {
		echo "Error !!!";
		exit();
	}

	// jika result kosong maka masukkan data baru
	// jika telah ada maka diupdate
	if (mysqli_num_rows($result)==0) {
		$query = "INSERT INTO pv_pendidikan (id_pendidikan, nilai) VALUES ($id_pendidikan, $pv)";
	} else {
		$query = "UPDATE pv_pendidikan SET nilai=$pv WHERE id_pendidikan=$id_pendidikan";
	}


	$result = mysqli_query($kon, $query);
	if(!$result) {
		echo "Gagal memasukkan / update nilai priority vector pendidikan";
		exit();
	}

}

// mencari Principe Eigen Vector (λ maks)
function getEigenVector($matrik_a,$matrik_b,$n) {
	$eigenvektor = 0;
	for ($i=0; $i <= ($n-1) ; $i++) {
		$eigenvektor += ($matrik_a[$i] * (($matrik_b[$i]) / $n));
	}

	return $eigenvektor;
}

// mencari Cons Index
function getConsIndex($matrik_a,$matrik_b,$n) {
	$eigenvektor = getEigenVector($matrik_a,$matrik_b,$n);
	$consindex = ($eigenvektor - $n)/($n-1);

	return $consindex;
}

// Mencari Consistency Ratio
function getConsRatio($matrik_a,$matrik_b,$n) {
	$consindex = getConsIndex($matrik_a,$matrik_b,$n);
	$consratio = $consindex / getNilaiIR($n);

	return $consratio;
}

// menampilkan nilai IR
function getNilaiIR($jmlpendidikan) {
	include('config.php');
	$query  = "SELECT nilai FROM ir WHERE jumlah=$jmlpendidikan";
	$result = mysqli_query($kon, $query);
	while ($row = mysqli_fetch_array($result)) {
		$nilaiIR = $row['nilai'];
	}

	return $nilaiIR;
}
			


			// menampilkan tabel perbandingan bobot
function showTabelPerbandinganPendidikan($jenis,$pendidikan) {
include('config.php');
	$n = getJumlahPendidikan();
	

	$query = "SELECT nama_pendidikan FROM pendidikan ORDER BY id_pendidikan";
	$result	= mysqli_query($kon, $query);
	if (!$result) {
		echo "Error kon database!!!";
		exit();
	}

	// buat list nama pilihan
	while ($row = mysqli_fetch_array($result)) {
		$pilihan[] = $row['nama_pendidikan'];
	}

	// tampilkan tabel
	?>

	<form class="ui form" action="index.php?page=hasil-pendidikan" method="post">
	<table class="table">
		<thead>
			<tr>
				<th colspan="2">Pilih yang lebih penting</th>
				<th>Nilai Perbandingan</th>
			</tr>
		</thead>
		<tbody>

	<?php

	//inisialisasi
	$urut = 0;

	for ($x=0; $x <= ($n - 2); $x++) {
		for ($y=($x+1); $y <= ($n - 1) ; $y++) {

			$urut++;

	?>
			<tr>
				<td>
					<div class="field">
							<div class="ui radio checkbox">
							<input name="pilih<?php echo $urut?>" value="1" checked type="radio">
							<label><?php echo $pilihan[$x]; ?></label>
						</div>
					</div>
				</td>
				<td>
					<div class="field">
						<div class="ui radio checkbox">
							<input name="pilih<?php echo $urut?>" value="2" type="radio">
							<label><?php echo $pilihan[$y]; ?></label>
						</div>
					</div>
				</td>
				<td>
					<div class="field">

	<?php
	
		$nilai = getNilaiPerbandinganPendidikan($x,$y);
	
		
	

	?>
						<input type="text" class="form-control" name="bobot<?php echo $urut?>" value="<?php echo $nilai?>" required>
					</div>
				</td>
			</tr>
			<?php
		}
	}

	?>
		</tbody>
	</table>
	<input type="text" name="jenis" value="pendidikan" hidden>
	<br><br><input class="btn btn-primary" type="submit" name="submit" value="SUBMIT">
	</form>

	<?php
}

?>