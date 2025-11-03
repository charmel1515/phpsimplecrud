<?php 

include_once 'config/class-master.php';
include_once 'config/class-peserta.php';

$master = new MasterData();
$peserta = new Peserta();

// Mengambil daftar jenis lomba, kelas, dan jurusan
$jenisList = $master->getJenis();
$kelasList = $master->getKelas();
$jurusanList = $master->getJurusan();

// Mengambil data peserta berdasarkan id dari parameter GET
$dataPeserta = $peserta->getUpdatePeserta($_GET['id'] ?? null);

if(isset($_GET['status'])){
    if($_GET['status'] == 'failed'){
        echo "<script>alert('Gagal mengubah data peserta. Silakan coba lagi.');</script>";
    }
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
								<h3 class="mb-0">Edit Peserta</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Edit Data</li>
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
										<h3 class="card-title">Formulir Peserta</h3>
										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
												<i data-lte-icon="expand" class="bi bi-plus-lg"></i>
												<i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
											</button>
											<button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
												<i class="bi bi-x-lg"></i>
											</button>
										</div>
									</div>

									<form action="proses/proses-edit.php" method="POST">
									    <div class="card-body">
                                            <input type="hidden" name="id" value="<?php echo $dataPeserta['id']; ?>">

                                            <div class="mb-3">
                                                <label for="nip" class="form-label">Nomor Induk Peserta (NIP)</label>
                                                <input type="number" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP Peserta" value="<?php echo $dataPeserta['nip']; ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Lengkap Peserta" value="<?php echo $dataPeserta['nama']; ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="jurusan" class="form-label">Jurusan</label>
                                                <select class="form-select" id="jurusan" name="jurusan" required>
                                                    <option value="" selected disabled>Pilih Jurusan</option>
                                                    <?php 
                                                    foreach ($jurusanList as $jurusan){
                                                        // ✅ sesuaikan dengan tabel tb_jurusan
                                                        $selectedJurusan = ($dataPeserta['jurusan'] == $jurusan['kode_jurusan']) ? 'selected' : '';
                                                        echo '<option value="'.$jurusan['kode_jurusan'].'" '.$selectedJurusan.'>'.$jurusan['nama_jurusan'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat Lengkap" required><?php echo $dataPeserta['alamat']; ?></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="kelas" class="form-label">Kelas</label>
                                                <select class="form-select" id="kelas" name="kelas" required>
                                                    <option value="" selected disabled>Pilih Kelas</option>
                                                    <?php
                                                    foreach ($kelasList as $kelas){
                                                        // ✅ tabel tb_kelas sudah benar
                                                        $selectedKelas = ($dataPeserta['kelas'] == $kelas['id_kelas']) ? 'selected' : '';
                                                        echo '<option value="'.$kelas['id_kelas'].'" '.$selectedKelas.'>'.$kelas['nama_kelas'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="lomba" class="form-label">Jenis Lomba</label>
                                                <select class="form-select" id="lomba" name="lomba" required>
                                                    <option value="" selected disabled>Pilih Jenis Lomba</option>
                                                    <?php 
                                                    foreach ($jenisList as $jenis){
                                                        // ✅ sesuaikan dengan kolom tb_jenislomba
                                                        $selectedJenis = ($dataPeserta['lomba'] == $jenis['kode_jenislomba']) ? 'selected' : '';
                                                        echo '<option value="'.$jenis['kode_jenislomba'].'" '.$selectedJenis.'>'.$jenis['nama_lomba'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email Valid" value="<?php echo $dataPeserta['email']; ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="telp" class="form-label">Nomor Telepon</label>
                                                <input type="tel" class="form-control" id="telp" name="telp" placeholder="Masukkan Nomor Telepon/HP" value="<?php echo $dataPeserta['telp']; ?>" pattern="[0-9+\-\s()]{6,20}" required>
                                            </div>
									    </div>

									    <div class="card-footer">
                                            <button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='data-list.php'">Batal</button>
                                            <button type="submit" class="btn btn-warning float-end">Update Data</button>
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
