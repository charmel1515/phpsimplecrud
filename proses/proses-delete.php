<?php

// Memasukkan file class-peserta.php untuk mengakses class Peserta
include_once '../config/class-peserta.php';

// Membuat objek dari class Peserta
$peserta = new Peserta();

// Mengecek apakah parameter id dikirim melalui URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Mengambil id peserta dari parameter GET dan ubah ke integer
    $id = (int) $_GET['id'];

    // Memanggil method deletePeserta untuk menghapus data peserta berdasarkan id
    $delete = $peserta->deletePeserta($id);

    // Mengecek apakah proses delete berhasil atau tidak - true/false
    if ($delete) {
        // Jika berhasil, redirect ke halaman data-list.php dengan status deletesuccess
        header("Location: ../data-list.php?status=deletesuccess");
        exit;
    } else {
        // Jika gagal, redirect ke halaman data-list.php dengan status deletefailed
        header("Location: ../data-list.php?status=deletefailed");
        exit;
    }
} else {
    // Jika parameter id tidak valid atau tidak ada
    header("Location: ../data-list.php?status=invalidid");
    exit;
}

?>
