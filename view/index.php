<?php
include '../config/config.php';
include '../controller/barangController.php';
include '../handler/createHandler.php';
include '../handler/updateHandler.php';
include '../handler/useHandler.php';
include '../handler/stokHandler.php';

$data = getAllData();
$rows = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
    <title>Data-Inventory</title>
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
            </li>
        </ul>
    </div>
    <main>
        <nav></nav>
        <h2>Daftar Barang</h2>
        <p>
            <button data-target="modal1" class="light-blue darken-4 waves-effect waves-light btn-large btn modal-trigger">Tambah Barang</button>
        </p>

         <!-- Modal Structure -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <div class="container">
                    <h4 class="m-10">Tambah Barang</h4>
                    <form method="post">
                        <div class="input-field">
                            <input id="nama" name="kode" type="text" class="validate" required>
                            <label for="nama">Kode Barang</label>
                        </div>
                        <div class="input-field">
                            <input name="nama_barang" type="text" class="validate" required>
                            <label>Nama Barang</label>
                        </div>
                        <div class="input-field">
                            <input name="jumlah_barang" type="text" class="validate" required>
                            <label>Jumlah Barang</label>
                        </div>
                        <div class="input-field">
                            <select name="satuan_barang">
                                <option value="" disabled selected>Pilih Satuan</option>
                                <option value="pcs">pcs</option>
                                <option value="kg">kg</option>
                                <option value="liter">liter</option>
                                <option value="meter">meter</option>
                            </select>
                            <label>Satuan Barang</label>
                        </div>
                        <div class="input-field">
                            <input name="harga_beli" type="text" class="validate" required>
                            <label>Harga Beli</label>
                        </div>
                        <p>
                            <label>
                                <input name="status" type="radio" value="1" />
                                <span>Available</span>
                            </label>
                            </p>
                            <p>
                            <label>
                                <input name="status" type="radio" value="0" />
                                <span>Non Available</span>
                            </label>
                        </p>
                        <input type="submit" value="simpan" class="light-blue darken-4 waves-effect waves-light btn-large">
                    </form>                   
                </div>
            </div>
        </div>

        <div id="modal2" class="modal">
            <div class="modal-content">
                <div class="container">
                <h4 class="m-10">Use Barang</h4>
                <form method="post" action="../controller/barangController.php?action=use">
                    <div class="input-field">
                    <input type="hidden" name="id" id="inputIdBarang">
                    <input id="jumlah_barang" name="jumlah_barang" type="text" class="validate" required>
                    <label for="jumlah_barang">Jumlah Barang</label>
                    </div>
                    <button type="submit" name="submit" class="btn blue waves-effect waves-light btn-large">Simpan</button>
                </form>
                </div>
            </div>
        </div>

        <div id="modal3" class="modal">
            <div class="modal-content">
                <div class="container">
                <h4 class="m-10">Edit Stok</h4>
                <form method="post" action="../controller/barangController.php?action=stock">
                    <div class="input-field">
                    <input type="hidden" name="id" id="inputIdBarang">
                    <input id="jumlah_barang" name="jumlah_barang" type="text" class="validate" required>
                    <label for="jumlah_barang">Jumlah Barang</label>
                    </div>
                    <button type="submit" name="submit" class="btn blue waves-effect waves-light btn-large">Simpan</button>
                </form>
                </div>
            </div>
        </div>

        <table border=1 cellpadding=8 cellspacing=0>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Satuan Barang</th>
                <th>Harga Beli</th>
                <th>Status Barang</th>
                <th>Action</th>
            </tr>
            <?php
                $no = 1;
                while($row = mysqli_fetch_assoc($data)){ 
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row["kode_barang"] ?></td>
                <td><?= $row["nama_barang"] ?></td>
                <td><?= $row["jumlah_barang"] ?></td>
                <td><?= $row["satuan_barang"] ?></td>
                <td><?= $row["harga_beli"] ?></td>
                <td>
                    <?php 
                        if($row['status_barang'] == 1) {
                            echo "Available";
                        }else {
                            echo "Not-Available";
                        }
                    ?>
                </td>
                <td>
                    <a href="edit.php?id=<?= $row['id_barang'] ?>" name="edit" class="btn btn-medium amber lighten-1 waves-effect waves-light">
                       Edit
                    </a>
                    <a href="../controller/barangController.php?action=delete&id=<?= $row['id_barang'] ?>"
                        onclick="return confirm('Yakin ingin hapus data ini?')"
                        class="red darken-3 waves-effect waves-light btn-medium btn">
                        Delete
                    </a>
                    <button 
                        class="btn modal-trigger waves-effect waves-light btn-medium" 
                        data-target="modal2" 
                        data-id="<?= $row['id_barang'] ?>"
                        >
                        Use
                    </button>
                    <button 
                        class="blue darken-4 btn modal-trigger waves-effect waves-light btn-medium" 
                        data-target="modal3" 
                        data-id="<?= $row['id_barang'] ?>"
                        >
                        Tambah Stok
                    </button>
                </td>
            </tr>
            <?php } ?>
        </table>

    </main>

    <script src="../js/materialize.min.js"></script>
    <script src="../js/sideNav.js"></script>
    <script src="../js/modals.js"></script>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.modal');
        M.Modal.init(elems); // Inisialisasi modal Materialize
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.modal-trigger');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
            const idBarang = this.getAttribute('data-id');
            document.querySelector('#modal2 input[name="id"]').value = idBarang;
            });
        });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.modal-trigger');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
            const idBarang = this.getAttribute('data-id');
            document.querySelector('#modal3 input[name="id"]').value = idBarang;
            });
        });
        });
    </script>
</body>
</html>