<?php
include '../config/config.php';
include '../controller/barangController.php';
$data = getAllData();
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
                <a href="#name"><span class="white-text name">John Doe</span></a>
                <a href="#email"><span class="white-text email">jdandturk@gmail.com</span></a>
                </div>
            </li>
            <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
            <li><a href="#!">Second Link</a></li>
            <li><div class="divider"></div></li>
            <li><a class="subheader">Subheader</a></li>
            <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
        </ul>
    </div>

    <nav></nav>

    <main>

        <h2>Daftar Barang</h2>
        <p>
            <button data-target="modal1" class="light-blue darken-4 waves-effect waves-light btn-large btn modal-trigger">Tambah Barang</button>
        </p>

         <!-- Modal Structure -->
        <div id="modal1" class="modal">
            <div class="modal-content">
                <div class="container">
                    <h4 class="m-10">Tambah Barang</h4>
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
                        <select name="satuan-barang">
                            <option value="" disabled selected>Pilih Satuan</option>
                            <option value="pcs">pcs</option>
                            <option value="kg">kg</option>
                            <option value="liter">liter</option>
                            <option value="meter">meter</option>
                        </select>
                        <label>Satuan Barang</label>
                    </div>
                    <div class="input-field">
                        <input name="harga-beli" type="text" class="validate" required>
                        <label>Harga Beli</label>
                    </div>
                    <p>
                        <label>
                            <input name="status" type="radio" value="Available" />
                            <span>Available</span>
                        </label>
                        </p>
                        <p>
                        <label>
                            <input name="status" type="radio" value="Non Available" />
                            <span>Non Available</span>
                        </label>
                    </p>
                    <button class="light-blue darken-4 waves-effect waves-light btn-large">Tambah</button>
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
                <td><?= $row["status_barang"] ?></td>
                <td>
                    <button class="red darken-3 waves-effect waves-light btn-large"><a href=""></a>Delete</button>
                    <button class="amber lighten-1 waves-effect waves-light btn-large"><a href=""></a>Edit</button>
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
    </script>
</body>
</html>