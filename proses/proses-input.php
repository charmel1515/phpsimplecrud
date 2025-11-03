<?php

// Memasukkan file class-mahasiswa.php untuk mengakses class Mahasiswa
include '../config/class-peserta.php';
// Membuat objek dari class Mahasiswa
$peserta = new Peserta();
// Mengambil data mahasiswa dari form input menggunakan metode POST dan menyimpannya dalam array
$dataPeserta = [
    'nip' => $_POST['nip'],
    'nama' => $_POST['nama'],
    'lomba' => $_POST['lomba'],
    'kelas' => $_POST['kelas'],
    'email' => $_POST['email'],
    'telp' => $_POST['telp'],
    'jurusan' => $_POST['jurusan'],
];
// Memanggil method inputMahasiswa untuk memasukkan data mahasiswa dengan parameter array $dataMahasiswa
$input = $peserta->inputPeserta($dataPeserta);
// Mengecek apakah proses input berhasil atau tidak - true/false
if($input){
    // Jika berhasil, redirect ke halaman data-list.php dengan status inputsuccess
    header("Location: ../data-list.php?status=inputsuccess");
} else {
    // Jika gagal, redirect ke halaman data-input.php dengan status failed
    header("Location: ../data-input.php?status=failed");
}

?>