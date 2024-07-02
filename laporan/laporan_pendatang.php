<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Laporan Surat Pendatang</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
			
			</div>
			<br>
			<form target="_blank" action="report/laporan_pendatang.php" method="post">
			<table class="table">
			    <tr>
			        <td>Dari Tanggal</td>
			        <td>:</td>
			        <td><input type="date" class="form-control" name="dari" required></td>
			    </tr>
			    <tr>
			        <td>Sampai Tanggal</td>
			        <td>:</td>
			        <td><input type="date" class="form-control" name="sampai" required></td>
			    </tr>
			    <tr>
			        <td colspan="3"><input type="submit" name="cetak" class="btn btn-primary" value="Cetak Laporan"></td>
			    </tr>
			</table>
			</form>
		</div>
	</div>
	<!-- /.card-body -->