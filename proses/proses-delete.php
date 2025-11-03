<?php

// Memasukkan file class-peserta.php untuk mengakses class Peserta
include_once '../config/class-peserta.php';
// Membuat objek dari class peserta
$peserta = new Peserta();
// Mengambil id peserta dari parameter GET
$id = $_GET['id'];
// Memanggil method deletePeserta untuk menghapus data peserta berdasarkan id
$delete = $peserta->deletePeserta($id);
// Mengecek apakah proses delete berhasil atau tidak - true/false
if($delete){
    // Jika berhasil, redirect ke halaman data-list.php dengan status deletesuccess
    header("Location: ../data-list.php?status=deletesuccess");
} else {
    // Jika gagal, redirect ke halaman data-list.php dengan status deletefailed
    header("Location: ../data-list.php?status=deletefailed");
}

?>