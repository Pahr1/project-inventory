<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (editStok($_POST)){
        
    }else {
        echo "Gagal Update data!";
    }
}

if (isset($_GET['pop'])){
    if ($_GET['pop'] == 'stok') {
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
    }elseif($_GET['pop'] == 'more') {
         echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Jumlah Harus Lebih Dari 0',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Hapus parameter 'pop' dari URL tanpa reload
                    const url = new URL(window.location);
                    url.searchParams.delete('pop');
                    window.history.replaceState({}, document.title, url);
                });
            </script>
        ";
    }else {
         echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Data Tidak Di Temukan!',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Hapus parameter 'pop' dari URL tanpa reload
                    const url = new URL(window.location);
                    url.searchParams.delete('pop');
                    window.history.replaceState({}, document.title, url);
                });
            </script>
        ";
    }
}