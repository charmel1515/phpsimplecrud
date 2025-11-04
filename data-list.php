<?php

include_once 'config/class-peserta.php';
$peserta = new Peserta();

// Menampilkan alert berdasarkan status yang diterima melalui parameter GET
if(isset($_GET['status'])){
	// Mengecek nilai parameter GET 'status' dan menampilkan alert yang sesuai menggunakan JavaScript
	if($_GET['status'] == 'inputsuccess'){
		echo "<script>alert('Data peserta berhasil ditambahkan.');</script>";
	} else if($_GET['status'] == 'editsuccess'){
		echo "<script>alert('Data peserta berhasil diubah.');</script>";
	} else if($_GET['status'] == 'deletesuccess'){
		echo "<script>alert('Data peserta berhasil dihapus.');</script>";
	} else if($_GET['status'] == 'deletefailed'){
		echo "<script>alert('Gagal menghapus data peserta. Silakan coba lagi.');</script>";
	}
}

// Ambil semua data peserta
$dataPeserta = $peserta->getAllPeserta();

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
								<h3 class="mb-0">Daftar Peserta</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Beranda</li>
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
										<h3 class="card-title">Tabel Peserta</h3>
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

									<div class="card-body p-0 table-responsive">
										<table class="table table-striped" role="table">
											<thead>
												<tr>
													<th>No</th>
													<th>NIP</th>
													<th>Nama Peserta</th>
													<th>Jurusan</th>
													<th>Kelas</th>
													<th>Lomba Diikuti</th>
													<th>Telp</th>
													<th>Email</th>
													<th class="text-center">Status</th>
													<th class="text-center">Aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php
													if(count($dataPeserta) == 0){
													    echo '<tr class="align-middle">
															<td colspan="10" class="text-center">Tidak ada data peserta.</td>
														</tr>';
													} else {
														foreach ($dataPeserta as $index => $pes){
															// Menampilkan status dalam bentuk badge
															$statusBadge = '';
															if($pes['status'] == 1){
															    $statusBadge = '<span class="badge bg-success">Aktif</span>';
															} elseif($pes['status'] == 2){
															    $statusBadge = '<span class="badge bg-danger">Tidak Aktif</span>';
															} elseif($pes['status'] == 3){
															    $statusBadge = '<span class="badge bg-warning text-dark">Cuti</span>';
															} elseif($pes['status'] == 4){
															    $statusBadge = '<span class="badge bg-primary">Lulus</span>';
															} else {
                                                                $statusBadge = '<span class="badge bg-secondary">Unknown</span>';
                                                            }

															echo '<tr class="align-middle">
																<td>'.($index + 1).'</td>
																<td>'.$pes['nip'].'</td>
																<td>'.$pes['nama'].'</td>
																<td>'.$pes['jurusan'].'</td>
																<td>'.$pes['kelas'].'</td>
																<td>'.$pes['lomba'].'</td>
																<td>'.$pes['telp'].'</td>
																<td>'.$pes['email'].'</td>
																<td class="text-center">'.$statusBadge.'</td>
																<td class="text-center">
																	<button type="button" class="btn btn-sm btn-warning me-1" onclick="window.location.href=\'data-edit.php?id='.$pes['id_peserta'].'\'"><i class="bi bi-pencil-fill"></i> Edit</button>
																	<button type="button" class="btn btn-sm btn-danger" onclick="if(confirm(\'Yakin ingin menghapus data peserta ini?\')){window.location.href=\'proses/proses-delete.php?id='.$pes['id_peserta'].'\'}"><i class="bi bi-trash-fill"></i> Hapus</button>
																</td>
															</tr>';
														}
													}
												?>
											</tbody>
										</table>
									</div>

									<div class="card-footer">
										<button type="button" class="btn btn-primary" onclick="window.location.href='data-input.php'"><i class="bi bi-plus-lg"></i> Tambah Peserta</button>
									</div>
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
