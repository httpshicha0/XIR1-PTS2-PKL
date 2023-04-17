<!-- Database: rumah_sakit || Table: dokter -->
<?php 
include 'header.php'; 
include 'config.php';
?>

<!-- button triger -->
<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#Meow">
	Tambah Data
</button>
<!-- button triger -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Data Dokter</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<!-- Menanampilkan data || Table: dokter -->
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr class="text-center">
						<th width="45">No</th>
						<th>NIP</th>
						<th>Nama</th>
						<th>Alamat</th>
						<th>No Telp</th>
						<th>Tarif</th>
						<th>Spesialis</th>
						<th width="150">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php     
						$no=1;
						$query = "SELECT * FROM `dokter`";
						$exec = mysqli_query($db, $query);
						while($res = mysqli_fetch_assoc($exec)):
					?>
					<tr>
						<td class="text-center"><?= $no++ ?></td>
						<td><?= $res['nip'] ?></td>
						<td><?= $res['nama_dokter'] ?></td>
						<td><?= $res['alamat_dokter'] ?></td>
						<td><?= $res['no_telpon'] ?></td>
						<td><?= $res['tarif_dokter'] ?></td>
						<td><?= $res['spesialis'] ?></td>
						<td class="text-center">
							<div class="btn-group mr-2" role="group" aria-label="Action group button">
								<!-- Tombol edit data angkatan -->
								<a href="#" class="view_data btn btn-sm btn-warning" data-toggle="modal" 
								data-target="#editdokter" id="<?php echo $res['id_dokter']; ?>">
								Perbaharui</a>
								<!-- Tombol hapus data angkatan -->
								<a href="index.php?id_dokter=<?= $res['id_dokter']?>" class="btn btn-sm btn-danger"
								onclick="return confirm('Apakah Anda yakin ingin menghapus data pada baris ini?')">
								Hapus</a>
							</div>
						</td>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php include 'footer.php'; ?>

<!-- Modal untuk tambah data-->
<div class="modal fade" id="Meow" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form Tambah Data Dokter</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="index.php" method="POST">
					<label>NIP</label>
					<input type="text" name="nip" placeholder="196912652005122056" class="form-control mb-2">
					<label>Nama</label>
					<input type="text" name="nama_dokter" placeholder="Severus Snape, Sp.Park" class="form-control mb-2">
					<label>Alamat</label>
					<textarea class="form-control mt-2" name="alamat_dokter" placeholder="Grimmauld Place No. 12"></textarea>
					<label>No Telp</label>
					<input type="text" name="no_telpon" placeholder="081287678766" class="form-control mb-2">
					<label>Tarif</label>
					<input type="text" name="tarif_dokter" placeholder="500.000" class="form-control mb-2">
					<label>Spesialis</label>
					<input type="text" name="spesialis" placeholder="Parasitologi" class="form-control mb-2">
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
						<button type="Submit" name="simpan" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal untuk edit data-->
<div class="modal fade" id="editdokter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form Perbaharui Data Dokter</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body" id="edit">
				<!-- form edit data dipisah ke dalam file view.php -->
			</div>
    	</div>
 	</div>
</div>

<!-- script ajax -->
<script type="text/javascript">
	$('.view_data').click(function(){
		var id_dokter = $(this).attr('id');
		$.ajax({
			url: 'view.php',
			method: 'POST',
			data: {id_dokter:id_dokter},
			success:function(data){
				$('#edit').html(data)
				$('#editdokter').modal('show');
			}
		})
	})
</script>

<?php 
//Proses tambah data ke dalam tabel database
if(isset($_POST['simpan'])){
    $nip = htmlentities(strip_tags(strtoupper($_POST['nip'])));
    $nama_dokter = htmlentities(strip_tags(strtoupper($_POST['nama_dokter'])));
    $alamat_dokter = htmlentities(strip_tags(strtoupper($_POST['alamat_dokter'])));
    $no_telpon = htmlentities(strip_tags(strtoupper($_POST['no_telpon'])));
	$tarif_dokter = htmlentities(strip_tags(strtoupper($_POST['tarif_dokter'])));
	$spesialis = htmlentities(strip_tags(strtoupper($_POST['spesialis'])));
    $query = "INSERT INTO dokter (nip,nama_dokter,alamat_dokter,no_telpon,tarif_dokter,spesialis) 
			VALUES ('$nip', '$nama_dokter', '$alamat_dokter', '$no_telpon', '$tarif_dokter', '$spesialis')";
    $exec = mysqli_query($db, $query);
    if($exec){
      echo "<script>alert('Data dokter berhasil disimpan')
      document.location = 'index.php';</script>";
    }else{
      echo "<script>alert('Data dokter gagal disimpan')
	  document.location = 'index.php';</script>";
    }
  }

//Proses hapus data pada tabel database
if(isset($_GET['id_dokter'])){
    $id_dokter = $_GET['id_dokter'];
	$exec = mysqli_query($db, "DELETE FROM dokter WHERE id_dokter='$id_dokter'");
    if($exec){
      echo "<script>alert('Data dokter berhasil dihapus')
      document.location = 'index.php';</script>";
    }else{
      echo "<script>alert('Data dokter gagal dihapus')
	  document.location = 'index.php';</script>";
    }
  }

//Proses perbaharui data pada tabel database
if(isset($_POST['soto'])){
    $id_dokter = $_POST['id_dokter'];
	$nip = $_POST['nip'];
	$nama_dokter = (ucwords($_POST['nama_dokter']));
	$alamat_dokter = (ucwords($_POST['alamat_dokter']));
	$no_telpon = $_POST['no_telpon'];
	$tarif_dokter = $_POST['tarif_dokter'];
	$spesialis = (ucwords($_POST['spesialis']));
	$query = "UPDATE dokter SET nip='$nip', nama_dokter='$nama_dokter', alamat_dokter='$alamat_dokter',
			no_telpon='$no_telpon', tarif_dokter='$tarif_dokter', spesialis='$spesialis' 
			WHERE id_dokter = '$id_dokter'";
	$exec = mysqli_query($db, $query);
    if($exec){
      echo "<script>alert('Data dokter berhasil diperbaharui')
      document.location = 'index.php';</script>";
    }else{
      echo "<script>alert('Data dokter gagal diperbaharui')
	  document.location = 'index.php';</script>";
    }
  }

?>