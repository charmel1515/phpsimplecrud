<?php

// Memasukkan file class-peserta.php untuk mengakses class Peserta
include '../config/class-peserta.php';

// Membuat objek dari class Peserta
$peserta = new Peserta();

// Mengecek apakah form dikirim melalui metode POST
if (isset($_POST['nip'])) {

    // Mengambil data peserta dari form input menggunakan metode POST dan menyimpannya dalam array
    $dataPeserta = [
        'nip' => $_POST['nip'],
        'nama' => $_POST['nama'],
        'lomba' => $_POST['lomba'],
        'kelas' => $_POST['kelas'],
        'email' => $_POST['email'],
        'telp' => $_POST['telp'],
        'jurusan' => $_POST['jurusan'],
    ];

    // Memanggil method inputPeserta untuk memasukkan data peserta
    $input = $peserta->inputPeserta($dataPeserta);

    // Mengecek apakah proses input berhasil atau tidak
    if ($input) {
        // Jika berhasil, redirect ke halaman data-list.php dengan status inputsuccess
        header("Location: ../data-list.php?status=inputsuccess");
        exit;
    } else {
        // Jika gagal, redirect ke halaman data-input.php dengan status failed
        header("Location: ../data-input.php?status=failed");
        exit;
    }

} else {
    // Jika form tidak diisi atau diakses langsung
    header("Location: ../data-input.php?status=invalid");
    exit;
}

?>
