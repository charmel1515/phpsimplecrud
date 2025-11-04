<?php 

include_once 'config/class-master.php';
$master = new MasterData();
// Mengambil daftar program studi, kelas, dan status mahasiswa
$jenisList = $master->getJenis();
// Mengambil daftar kelas
$kelasList = $master->getKelas();
// Mengambil daftar status mahasiswa
$jurusanList = $master->getJurusan();
// Menampilkan alert berdasarkan status yang diterima melalui parameter GET
if(isset($_GET['jurusan'])){
    // Mengecek nilai parameter GET 'status' dan menampilkan alert yang sesuai menggunakan JavaScript
    if($_GET['jurusan'] == 'failed'){
        echo "<script>alert('Gagal menambahkan data peserta. Silakan coba lagi.');</script>";
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
                                    <form action="proses/proses-input.php" method="POST">
									    <div class="card-body">
                                            <div class="mb-3">
                                                <label for="nip" class="form-label">Nomor Induk Peserta</label>
                                                <input type="number" class="form-control" id="nip" name="nip" placeholder="Masukkan Nomor Induk Siswa" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Lengkap Siswa" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="lomba" class="form-label">Masukan Lomba yang Diikuti</label>
                                                <select class="form-select" id="lomba" name="lomba" required>
                                                    <option value="" selected disabled>Pilih Lomba</option>
                                                    <?php 
                                                    // Iterasi daftar program studi dan menampilkannya sebagai opsi dalam dropdown
                                                    foreach ($jenisList as $jenis){
                                                        echo '<option value="'.$jenis['id'].'">'.$jenis['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="kelas" class="form-label">Kelas</label>
                                                <select class="form-select" id="kelas" name="kelas" required>
                                                    <option value="" selected disabled>Pilih Kelas</option>
                                                    <?php
                                                    // Iterasi daftar kelas dan menampilkannya sebagai opsi dalam dropdown
                                                    foreach ($kelasList as $kelas){
                                                        echo '<option value="'.$kelas['id'].'">'.$kelas['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan Email Valid dan Benar" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="telp" class="form-label">Nomor Telepon</label>
                                                <input type="number" class="form-control" id="telp" name="telp" placeholder="Masukkan Nomor Telpon/HP" pattern="[0-9+\-\s()]{6,20}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-label">Jurusan</label>
                                                <select class="form-select" id="jurusan" name="jurusan" required>
                                                    <option value="" selected disabled>Pilih Jurusan</option>
                                                    <?php
                                                    // Iterasi daftar kelas dan menampilkannya sebagai opsi dalam dropdown
                                                    foreach ($jurusanList as $jurusan){
                                                        echo '<option value="'.$jurusan['id'].'">'.$jurusan['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
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