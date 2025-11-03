<?php

// Memasukkan file class-master.php untuk mengakses class MasterData
include '../config/class-master.php';
// Membuat objek dari class MasterData
$master = new MasterData();
// Mengecek aksi yang dilakukan berdasarkan parameter GET 'aksi'
if($_GET['aksi'] == 'inputkelas'){
    // Mengambil data provinsi dari form input menggunakan metode POST dan menyimpannya dalam array
    $dataKelas = [
        'nama' => $_POST['nama']
    ];
    // Memanggil method inputProvinsi untuk memasukkan data provinsi dengan parameter array $dataProvinsi
    $input = $master->inputKelas($dataKelas);
    if($input){
        header("Location: ../master-kelas-list.php?status=inputsuccess");
    } else {
        header("Location: ../master-kelas-input.php?status=failed");
    }
} elseif($_GET['aksi'] == 'updatekelas'){
    // Mengambil data provinsi dari form edit menggunakan metode POST dan menyimpannya dalam array
    $dataKelas = [
        'id' => $_POST['id_kelas'],
        'nama' => $_POST['nama_kelas']
    ];
    // Memanggil method updateProvinsi untuk mengupdate data provinsi dengan parameter array $dataProvinsi
    $update = $master->updateKelas($dataKelas);
    if($update){
        header("Location: ../master-kelas-list.php?status=editsuccess");
    } else {
        header("Location: ../master-kelas-edit.php?id=".$dataKelas['id']."&status=failed");
    }
} elseif($_GET['aksi'] == 'deletekelas'){
    // Mengambil id provinsi dari parameter GET
    $id = $_GET['id'];
    // Memanggil method deleteProvinsi untuk menghapus data provinsi berdasarkan id
    $delete = $master->deleteKelas($id);
    if($delete){
        header("Location: ../master-kelas-list.php?status=deletesuccess");
    } else {
        header("Location: ../master-kelas-list.php?status=deletefailed");
    }
}

?>