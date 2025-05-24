<?php 
include '../config/config.php';
include '../controller/barangController.php';
include '../handler/updateHandler.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;
$query = mysqli_query($conn, "SELECT * FROM tb_inventory WHERE id_barang='$id'");
$getData = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <ul id="slide-out" class="sidenav sidenav-fixed">
            <li>
                <div class="user-view">
                    <div class="background">
                        <img src="images/office.jpg">
                    </div>
                    <a href="#user"><img class="circle" src="images/yuna.jpg"></a>
                    <a href="#name"><span class="black-text name">John Doe</span></a>
                    <a href="#email"><span class="black-text email">jdandturk@gmail.com</span></a>
                </div>
                <li><a href="index.php">Daftar Barang</a></li>
            </li>
        </ul>
    </div>
    <main>
        <h4>Edit Barang</h4>
        <form id="formEdit" method="post" action="">
            <input type="hidden" name="form_type" value="update">
            <input type="hidden" id="idInputHidden" name="id" value="<?= $getData['id_barang'] ?>">
            Kode Barang: 
            <input type="text" name="kode" id="edit_kode" value="<?= $getData['kode_barang'] ?>"><br>
            Nama Barang: 
            <input type="text" name="nama_barang" id="edit_nama" value="<?= $getData['nama_barang'] ?>"><br>
            Jumlah: 
            <input type="number" name="jumlah_barang" id="edit_jumlah" value="<?= $getData['jumlah_barang'] ?>"><br>
            Satuan:
            <div class="input-field">
                <select name="satuan_barang" id="">
                    <option value="" disabled <?= $getData['satuan_barang'] == "" ? 'selected' : '' ?>>Pilih Satuan</option>
                    <option value="pcs" <?= $getData['satuan_barang'] == 'pcs' ? 'selected' : '' ?>>pcs</option>
                    <option value="kg" <?= $getData['satuan_barang'] == 'kg' ? 'selected' : '' ?>>kg</option>
                    <option value="liter" <?= $getData['satuan_barang'] == 'liter' ? 'selected' : '' ?>>liter</option>
                    <option value="meter" <?= $getData['satuan_barang'] == 'meter' ? 'selected' : '' ?>>meter</option>
                </select>
                <label>Satuan Barang</label>
            </div>
            Harga Beli: 
            <input type="number" name="harga_beli" id="edit_harga" step="0.01" value="<?= $getData['harga_beli'] ?>"><br>
            Status:
            <label>
                <input type="radio" name="status" value="1" id="status_avail"
                    <?= $getData['status_barang'] == 1 ? 'checked' : '' ?>>
                <span>Available</span>
                </label>
                <label>
                <input type="radio" name="status" value="0" id="status_notavail"
                    <?= $getData['status_barang'] == 0 ? 'checked' : '' ?>>
                <span>Not Available</span>
            </label>
            <br><br>
            <button type="submit" class="btn green">Simpan</button>
        </form>
    </main>

    <script src="../js/materialize.min.js"></script>
    <script src="../js/sideNav.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
        });

        if (window.history.replaceState) {
            const url = new URL(window.location);
            url.searchParams.delete('alert');
            window.history.replaceState(null, '', url);
        }
    </script>
</body>
</html>