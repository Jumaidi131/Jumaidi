<?php include_once ('../header.php'); ?>

<div class="box">
	<h1><img src="../img/doctor.png" width="60px">Dokter</h1>
	<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="glyphicon glyphicon-align-justify"></i>&nbsp;Menu</a>
	<h4>
		<small>Data Dokter</small>
		<div class="pull-right">
			<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
			<a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Dokter </a>
		</div>
	</h4>
	<form method="post" name="proses">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover" id="dokter">
			<thead>
				<tr>
					<th>
						<center>
							<input type="checkbox" id="select_all" value="">
						</center>					
					</th>
					<th>No.</th>
					<th>Nama Dokter</th>
					<th>Spesialis</th>
					<th>Alamat</th>
					<th>No. Telepon</th>
					<th class="text-center"><i class="glyphicon glyphicon-cog"></i></th>
				</tr>
			</thead>
			<tbody>
			<?php
			$no = 1;
			$sql_poli = mysqli_query($con, "SELECT * FROM tb_dokter")or die(mysqli_error($con));
				while($data = mysqli_fetch_array($sql_poli)) {?>
					<tr>
						<td align="center">
							<input type="checkbox" name="checked[]" class="check" value="<?=$data['id_dokter'] ?>">
						</td>
						<td><?=$no++ ?>.</td>
						<td><?=$data['nama_dokter'] ?></td>
						<td><?=$data['spesialis'] ?></td>
						<td><?=$data['alamat'] ?></td>
						<td><?=$data['no_telp'] ?></td>
						<td align="center">
							<a href="edit.php?id=<?=$data['id_dokter']?>" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-edit"></i></a>
						</td>
					</tr>
				<?php	
				}
			?>
			</tbody>
		</table>
	</div>
</form>
<div class="box pull-right">
	<button class="btn btn-danger btn-sm" onclick="hapus()"><i class="glyphicon glyphicon-trash"></i> Delete</button>
</div>
</div>
<!-- membuat multiple -->
<script>
$(document).ready(function() {
	// tables client-side
	// sesuai (id) table yang sudah di beri nama
	$('#dokter').DataTable({
		columnDefs: [
			{
				// shorting yang tidak diperlukan
				"searchable": false,
				"orderable":false,
				// sesuai urutan tabel
				"targets": [0, 6]
			}
		],
		// agar shortig nomor ascending
		// dan tinggl atur urutan table mana yang mau di asc atau desc
		// 1(no) 2(nama dokter) 3(spesialis) 4(alamat) 5(no. telepon)
		"order": [1, "asc"]
	});

	$("#select_all").on("click", function() {
		if(this.checked){
			$(".check").each(function() {
				this.checked = true;
			})
		}else{
			$(".check").each(function() {
				this.checked = false;
			})
		}
	});

	$(".check").on("click", function() {
		if($(".check:checked").length == $(".check").length){
			$("#select_all").prop("checked", true)
		}else{
			$("#select_all").prop("checked", false)
		}
	})
})
function hapus(){
	var conf = confirm('Yakin akan menghapus data anda?');
	if(conf){
		document.proses.action = 'del.php';
		document.proses.submit();
	}
}
</script>

<?php include_once ('../footer.php'); ?>