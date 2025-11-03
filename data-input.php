<?php 
include_once 'config/class-master.php';
$master = new MasterData();

// Mengambil daftar jenis lomba, kelas, dan jurusan
$jenisList = $master->getJenis();
$kelasList = $master->getKelas();
$jurusanList = $master->getJurusan();

// Menampilkan alert jika gagal
if (isset($_GET['status']) && $_GET['status'] == 'failed') {
    echo "<script>alert('Gagal menambahkan data peserta. Silakan coba lagi.');</script>";
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include 'template/header.php'; ?>
</head>

<body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">

<div class="app-wrapper">

    <?php include 'template/navbar.php'; ?>
    <?php include 'template/sidebar.php'; ?>

    <main class="app-main">

        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Input Data Peserta</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Input Data</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Formulir Pendaftaran Peserta</h3>
                            </div>

                            <form action="proses/proses-input.php" method="POST">
                                <div class="card-body">

                                    <div class="mb-3">
                                        <label for="nip" class="form-label">Nomor Induk Peserta</label>
                                        <input type="number" class="form-control" id="nip" name="nip" placeholder="Masukkan Nomor Induk Peserta" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Lengkap Peserta" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="lomba" class="form-label">Jenis Lomba</label>
                                        <select class="form-select" id="lomba" name="lomba" required>
                                            <option value="" disabled selected>Pilih Jenis Lomba</option>
                                            <?php 
                                            if (!empty($jenisList)) {
                                                foreach ($jenisList as $jenis) {
                                                    // ✅ Perbaikan kolom sesuai database
                                                    echo '<option value="'.$jenis['kode_jenislomba'].'">'.$jenis['nama_jenislomba'].'</option>';
                                                }
                                            } else {
                                                echo '<option disabled>Data tidak tersedia</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kelas" class="form-label">Kelas</label>
                                        <select class="form-select" id="kelas" name="kelas" required>
                                            <option value="" disabled selected>Pilih Kelas</option>
                                            <?php 
                                            if (!empty($kelasList)) {
                                                foreach ($kelasList as $kelas) {
                                                    echo '<option value="'.$kelas['id_kelas'].'">'.$kelas['nama_kelas'].'</option>';
                                                }
                                            } else {
                                                echo '<option disabled>Data tidak tersedia</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="jurusan" class="form-label">Jurusan</label>
                                        <select class="form-select" id="jurusan" name="jurusan" required>
                                            <option value="" disabled selected>Pilih Jurusan</option>
                                            <?php 
                                            if (!empty($jurusanList)) {
                                                foreach ($jurusanList as $jurusan) {
                                                    echo '<option value="'.$jurusan['id_jurusan'].'">'.$jurusan['nama_jurusan'].'</option>';
                                                }
                                            } else {
                                                echo '<option disabled>Data tidak tersedia</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email Valid" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="telp" class="form-label">Nomor Telepon</label>
                                        <input type="tel" class="form-control" id="telp" name="telp" placeholder="Masukkan Nomor Telepon/HP" pattern="[0-9+\-\s()]{6,20}" required>
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='data-list.php'">Batal</button>
                                    <button type="reset" class="btn btn-secondary me-2 float-start">Reset</button>
                                    <button type="submit" class="btn btn-primary float-end">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <?php include 'template/footer.php'; ?>

</div>

<?php include 'template/script.php'; ?>

</body>
</html>
