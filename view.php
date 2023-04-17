<!-- Halo! Ini form edit/perbaharui data -->
<?php include 'config.php';

if(isset($_POST['id_dokter'])){
    $id_dokter = $_POST['id_dokter'];
    $exec = mysqli_query($db,"SELECT * FROM dokter WHERE id_dokter='$id_dokter'");
    $res = mysqli_fetch_assoc($exec);
    ?>
    <form action="index.php" method="POST">
        <div class="form-group">
            <input type="hidden" class="form-control" name="id_dokter" value="<?=
            $res['id_dokter'] ?>">
        </div>
        <div class="form-group">
            <label>NIP</label>
            <input type="text" class="form-control" name="nip" value="<?=
            $res['nip'] ?>">
        </div>
        <div class="form-group">
            <label>Nama Dokter</label>
            <input type="text" class="form-control" name="nama_dokter" value="<?=
            $res['nama_dokter'] ?>">
        </div>
        <div class="form-group">
            <label>Alamat Dokter</label>
            <textarea class="form-control mt-2" name="alamat_dokter"><?=$res['alamat_dokter'] ?></textarea>
        </div>
        <div class="form-group">
            <label>No Telpon</label>
            <input type="text" class="form-control" name="no_telpon" value="<?=
            $res['no_telpon'] ?>">
        </div>
        <div class="form-group">
            <label>Tarif Dokter</label>
            <input type="text" class="form-control" name="tarif_dokter" value="<?=
            $res['tarif_dokter'] ?>">
        </div>
        <div class="form-group">
            <label>Spesialis</label>
            <input type="text" class="form-control" name="spesialis" value="<?=
            $res['spesialis'] ?>">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="Submit" name="soto" class="btn btn-warning">Perbaharui</button>
        </div>
    </form>
<?php
}
?>