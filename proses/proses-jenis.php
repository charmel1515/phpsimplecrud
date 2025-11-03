<?php

// Memasukkan file class-master.php untuk mengakses class MasterData
include '../config/class-master.php';
// Membuat objek dari class MasterData
$master = new MasterData();
// Mengecek aksi yang dilakukan berdasarkan parameter GET 'aksi'
if($_GET['aksi'] == 'inputjenis'){
    // Mengambil data jenis dari form input menggunakan metode POST dan menyimpannya dalam array
    $dataJenis = [
        'id' => $_POST['id'],
        'nama' => $_POST['nama']
    ];
    // Memanggil method inputJenis untuk memasukkan data jenis dengan parameter array $dataProdi
    $input = $master->inputJenis($dataJenis);
    if($input){
        // Jika berhasil, redirect ke halaman master-jenis-list.php dengan status inputsuccess
        header("Location: ../master-jenis-list.php?status=inputsuccess");
    } else {
        // Jika gagal, redirect ke halaman master-jenis-input.php dengan status failed
        header("Location: ../master-jenis-input.php?status=failed");
    }
} elseif($_GET['aksi'] == 'updatejenis'){
    // Mengambil data jenis dari form edit menggunakan metode POST dan menyimpannya dalam array
    $dataJenis = [
        'id' => $_POST['id'],
        'nama' => $_POST['nama']
    ];
    // Memanggil method updateJenis untuk mengupdate data jenis dengan parameter array $dataProdi
    $update = $master->updateJenis($dataJenis);
    if($update){
        // Jika berhasil, redirect ke halaman master-jenis-list.php dengan status editsuccess
        header("Location: ../master-jenis-list.php?status=editsuccess");
    } else {
        // Jika gagal, redirect ke halaman master-jenis-edit.php dengan status failed dan membawa id jenis
        header("Location: ../master-jenis-edit.php?id=".$dataJenis['id']."&status=failed");
    }
} elseif($_GET['aksi'] == 'deletejenis'){
    // Mengambil id jenis dari parameter GET
    $id = $_GET['id'];
    // Memanggil method deleteProdi untuk menghapus data jenis berdasarkan id
    $delete = $master->deleteJenis($id);
    if($delete){
        // Jika berhasil, redirect ke halaman master-jenis-list.php dengan status deletesuccess
        header("Location: ../master-jenis-list.php?status=deletesuccess");
    } else {
        // Jika gagal, redirect ke halaman master-jenis-list.php dengan status deletefailed
        header("Location: ../master-jenis-list.php?status=deletefailed");
    }
}

?>