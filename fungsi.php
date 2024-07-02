<?php	
// mencari ID kriteria
// berdasarkan urutan ke berapa (C1, C2, C3)
function getKriteriaID($no_urut) {
	include('config.php');
	$query  = "SELECT id_kriteria FROM kriteria ORDER BY id_kriteria";
	$result = mysqli_query($kon, $query);

	while ($row = mysqli_fetch_array($result)) {
		$listID[] = $row['id_kriteria'];
	}

	return $listID[($no_urut)];
}
function getKriteriaIDI($no_urut) {
	include('config.php');
	$query  = "SELECT id_kriteria FROM kriteria ORDER BY id_kriteria";
	$result = mysqli_query($kon, $query);

	while ($row = mysqli_fetch_array($result)) {
		$listID[] = $row['id_kriteria'];
	}

	return $listID[($no_urut)];
}
// mencari nama kriteria
function getKriteriaNama($no_urut) {
	include('config.php');
	$query  = "SELECT nama_kriteria FROM kriteria ORDER BY id_kriteria";
	$result = mysqli_query($kon, $query);

	while ($row = mysqli_fetch_array($result)) {
		$nama[] = $row['nama_kriteria'];
	}

	return $nama[($no_urut)];
}


// mencari nilai bobot perbandingan kriteria
function getNilaiPerbandinganKriteria($kriteria1,$kriteria2) {
	include('config.php');

	$id_kriteria1 = getKriteriaID($kriteria1);
	$id_kriteria2 = getKriteriaID($kriteria2);

	$query  = "SELECT nilai FROM perbandingan_kriteria WHERE kriteria1 = $id_kriteria1 AND kriteria2 = $id_kriteria2";
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

// mencari jumlah kriteria
function getJumlahKriteria() {
	include('config.php');
	$query  = "SELECT count(*) FROM kriteria";
	$result = mysqli_query($kon, $query);
	while ($row = mysqli_fetch_array($result)) {
		$jmlData = $row[0];
	}

	return $jmlData;
}	

// memasukkan bobot nilai perbandingan kriteria
function inputDataPerbandinganKriteria($kriteria1,$kriteria2,$nilai) {
	include('config.php');

	$id_kriteria1 = getKriteriaIDI($kriteria1);
	$id_kriteria2 = getKriteriaIDI($kriteria2);

	$query  = "SELECT * FROM perbandingan_kriteria WHERE kriteria1 = $id_kriteria1 AND kriteria2 = $id_kriteria2";
	$result = mysqli_query($kon, $query);

	if (!$result) {
		echo "Error !!!";
		exit();
	}

	// jika result kosong maka masukkan data baru
	// jika telah ada maka diupdate
	if (mysqli_num_rows($result)==0) {
		$query = "INSERT INTO perbandingan_kriteria (kriteria1,kriteria2,nilai) VALUES ($id_kriteria1,$id_kriteria2,$nilai)";
	} else {
		$query = "UPDATE perbandingan_kriteria SET nilai=$nilai WHERE kriteria1=$id_kriteria1 AND kriteria2=$id_kriteria2";
	}

	$result = mysqli_query($kon, $query);
	if (!$result) {
		echo "Gagal memasukkan data perbandingan";
		exit();
	}

}


// memasukkan nilai priority vektor kriteria
function inputKriteriaPV ($id_kriteria,$pv) {
	include ('config.php');

	$query = "SELECT * FROM pv_kriteria WHERE id_kriteria=$id_kriteria";
	$result = mysqli_query($kon, $query);

	if (!$result) {
		echo "Error !!!";
		exit();
	}

	// jika result kosong maka masukkan data baru
	// jika telah ada maka diupdate
	if (mysqli_num_rows($result)==0) {
		$query = "INSERT INTO pv_kriteria (id_kriteria, nilai) VALUES ($id_kriteria, $pv)";
	} else {
		$query = "UPDATE pv_kriteria SET nilai=$pv WHERE id_kriteria=$id_kriteria";
	}


	$result = mysqli_query($kon, $query);
	if(!$result) {
		echo "Gagal memasukkan / update nilai priority vector kriteria";
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
function getNilaiIR($jmlKriteria) {
	include('config.php');
	$query  = "SELECT nilai FROM ir WHERE jumlah=$jmlKriteria";
	$result = mysqli_query($kon, $query);
	while ($row = mysqli_fetch_array($result)) {
		$nilaiIR = $row['nilai'];
	}

	return $nilaiIR;
}
			


			// menampilkan tabel perbandingan bobot
function showTabelPerbandingan($jenis,$kriteria) {
include('config.php');
	$n = getJumlahKriteria();
	

	$query = "SELECT nama_kriteria FROM kriteria ORDER BY id_kriteria";
	$result	= mysqli_query($kon, $query);
	if (!$result) {
		echo "Error kon database!!!";
		exit();
	}

	// buat list nama pilihan
	while ($row = mysqli_fetch_array($result)) {
		$pilihan[] = $row['nama_kriteria'];
	}

	// tampilkan tabel
	?>

	<form class="ui form" action="index.php?page=hasil-bobot" method="post">
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
	
		$nilai = getNilaiPerbandinganKriteria($x,$y);
	
		
	

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
	<input type="text" name="jenis" value="kriteria" hidden>
	<br><br><input class="btn btn-primary" type="submit" name="submit" value="SUBMIT">
	</form>

	<?php
}

?>