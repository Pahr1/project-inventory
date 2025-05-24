<?php
include '../config/config.php';
include '../view/footer.php';

if(isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'delete':
            deleteInventory();
            break;
        case 'use':
            useInventory();
            break;
        case 'stock':
            editStok();
            break;
    }
}


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
    $satuan     = $_POST['satuan_barang'];
    $hargaBeli  = $_POST['harga_beli'];
    $status     = $_POST['status'];

    $cekData = mysqli_query($conn, "SELECT kode_barang FROM tb_inventory WHERE kode_barang = '$kodeBarang'");

    // cek kode barang tidak boleh sama
    if(mysqli_num_rows($cekData) > 0) {
        header("Location: ../view/index.php?alert=duplicate");
        exit;
    }else {
        
        $tambah = mysqli_query($conn, "INSERT INTO tb_inventory (kode_barang, nama_barang, jumlah_barang, satuan_barang, harga_beli, status_barang) VALUES ('$kodeBarang', '$namaBarang', '$jumlah', '$satuan', '$hargaBeli', '$status')");

        if($tambah) {
            header("Location: ../view/index.php?alert=success");
            exit;
        }else {
            echo "<script>
            	Swal.fire(
            	 'Data gagal di tambah', '', 'warning'
            	).then((result) => {
                  if (result.isConfirmed) {
                    history.go(-1);
                  }
                });

              </script>";
            echo "Data gagal di tambah";
        }

    }


}

function updateInventory() {
    global $conn;

    $id = $_POST['id'];
    $kodeBarang = $_POST['kode'];
    $namaBarang = $_POST['nama_barang'];
    $jumlah     = $_POST['jumlah_barang'];
    $satuan     = $_POST['satuan_barang'];
    $hargaBeli  = $_POST['harga_beli'];
    $status     = $_POST['status'];
    
    
    $update = mysqli_query($conn, "UPDATE tb_inventory SET 
        kode_barang = '$kodeBarang',
        nama_barang = '$namaBarang',
        jumlah_barang = '$jumlah',
        satuan_barang = '$satuan',
        harga_beli = '$hargaBeli',
        status_barang = '$status'
        WHERE id_barang = '$id'
    ");

    if($update) {
        echo "<script>
					Swal.fire({
					  icon: 'success',
					  title: 'Input Data Berhasil!'
					}).then((result) => {
			          if (result.isConfirmed) {
			            location.replace('../view/index.php');
			          }
			        });
				  </script>";
    }else {
        echo "<script>
            Swal.fire(
                'Data gagal di tambah', '', 'warning'
            ).then((result) => {
                if (result.isConfirmed) {
                history.go(-1);
                }
            });

            </script>";
        echo "Data gagal di tambah";
    }
}


function deleteInventory() {
    global $conn;

    if(isset($_GET['id'])){
        $id = intval($_GET['id']);

        $delete = mysqli_query($conn, "DELETE FROM tb_inventory WHERE id_barang='$id'");

        if($delete) {
            header("Location: ../view/index.php?msg=deleted");
        } else {
            echo "<script>alert('Gagal menghapus data');</script>";
        }
    }

}

function useInventory() {
    global $conn;

    if (isset($_POST['submit'])) {
        $id = intval($_POST['id']);
        $jumlahPakai = intval($_POST['jumlah_barang']);

        $query = mysqli_query($conn, "SELECT jumlah_barang FROM tb_inventory WHERE id_barang = '$id'");
        $data = mysqli_fetch_assoc($query);

        //validasi
        if(!$data) {
            echo "<script>
                Swal.fire(
                    'Barang dengan tidak di temukan', '', 'warning'
                ).then((result) => {
                    if (result.isConfirmed) {
                    location.replace('../view/index.php');
                    }
                });

            </script>";
        }

        $stok = $data['jumlah_barang'];

        if($jumlahPakai > $stok) {
            header("Location: ../view/index.php?alert=invalid");
            exit;
        }

        //hitung sisa
        $sisaStok = $stok - $jumlahPakai;

        //update status dan stok
        $status = ($sisaStok == 0) ? 0 : 1;

        $update = mysqli_query($conn, "UPDATE tb_inventory SET jumlah_barang = '$sisaStok', status_barang = '$status' WHERE id_barang = '$id'");

        if($update) {
            header("Location: ../view/index.php?alert=use");
            exit;
        }
    }
}


function editStok() {
    global $conn;

    if (isset($_POST['submit'])) {
        $id = intval($_POST['id']);
        $tambahanJumlah = intval($_POST['jumlah_barang']);
        $query = mysqli_query($conn, "SELECT jumlah_barang, status_barang FROM tb_inventory WHERE id_barang = '$id'");
        $data = mysqli_fetch_assoc($query);

        if (!$data) {
            header("Location: ../view/index.php?pop=invalid");
            exit;
        }

        $jumlah  = $data['jumlah_barang'];
        $jumlahBarang = $jumlah + $tambahanJumlah;

        if ($tambahanJumlah == 0) {
            header("Location: ../view/index.php?pop=more");
            exit;
        }

        $statusLama = $data['status_barang'];
        $statusBaru = ($jumlah == 0 && $statusLama == 0) ? 1 :$statusLama;

        $updateStok = mysqli_query($conn, "UPDATE tb_inventory SET jumlah_barang='$jumlahBarang', status_barang = '$statusBaru' WHERE id_barang='$id'");

        if ($updateStok) {
            header("Location: ../view/index.php?pop=stok");
            exit;
        }
    }
}


