<?php
include '../config/config.php';

function getAllData() {
    global $conn;
    $query = mysqli_query($conn, "SELECT * FROM tb_inventory");
    return $query;
}

function createInventory() {
    global $conn;

    $kodeBarang = $_POST['kode'];
    $namaBarang = $_POST['nama_barang'];
    $jumlah     = $_POST['jumlah_barang'];

}

function updateInventory($id) {

}

function deleteInventory($id) {

}


