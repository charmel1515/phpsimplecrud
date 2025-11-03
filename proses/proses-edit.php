<?php

// Memasukkan file class-mahasiswa.php untuk mengakses class Mahasiswa
include_once '../config/class-peserta.php';
// Membuat objek dari class Mahasiswa
$peserta = new Peserta();
// Mengambil data mahasiswa dari form edit menggunakan metode POST dan menyimpannya dalam array
$dataPeserta = [
    'id' => $_POST['id'],
    'nip' => $_POST['nip'],
    'nama' => $_POST['nama'],
    'jurusan' => $_POST['jurusan'],
    'kelas' => $_POST['kelas'],
    'telp' => $_POST['telp'],
    'email' => $_POST['email'],
    'lomba' => $_POST['lomba'],
    
];
// Memanggil method editMahasiswa untuk mengupdate data peserta dengan parameter array $dataPeserta
$edit = $peserta->editPeserta($dataPeserta);
// Mengecek apakah proses edit berhasil atau tidak - true/false
if($edit){
    // Jika berhasil, redirect ke halaman data-list.php dengan status editsuccess
    header("Location: ../data-list.php?status=editsuccess");
} else {
    // Jika gagal, redirect ke halaman data-edit.php dengan status failed dan membawa id peserta
    header("Location: ../data-edit.php?id=".$dataPeserta['id']."&status=failed");
}

?>