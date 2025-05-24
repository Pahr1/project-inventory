<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (useInventory($_POST)){
        
    }else {
        echo "Gagal Update data!";
    }
}

if (isset($_GET['alert'])){
    if ($_GET['alert'] == 'use') {
        echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Hapus parameter 'pop' dari URL tanpa reload
                    const url = new URL(window.location);
                    url.searchParams.delete('pop');
                    window.history.replaceState({}, document.title, url);
                });
            </script> 
        ";
        return;
    }elseif ($_GET['alert'] == 'duplicate'){
        echo "           
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Kode Barang sudah ada!',
                    confirmButtonText: 'OK'
                });
            </script>
        ";
    }
}