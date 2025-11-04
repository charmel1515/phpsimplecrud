<?php

include_once 'config/class-peserta.php';
$peserta = new Peserta();
$kataKunci = '';

// Mengecek apakah parameter GET 'search' ada
if(isset($_GET['search'])){
	$kataKunci = $_GET['search'];
	$cariPeserta = $peserta->searchPeserta($kataKunci);
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
								<h3 class="mb-0">Cari Peserta</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Cari Data</li>
								</ol>
							</div>
						</div>
					</div>
				</div>

				<div class="app-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">

								<div class="card mb-3">
									<div class="card-header">
										<h3 class="card-title">Pencarian Peserta</h3>
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
									<div class="card-body">
										<form action="data-search.php" method="GET">
											<div class="mb-3">
												<label for="search" class="form-label">Masukkan NIP atau Nama Peserta</label>
												<input type="text" class="form-control" id="search" name="search" placeholder="Cari berdasarkan NIP atau Nama Peserta" value="<?php echo $kataKunci; ?>" required>
											</div>
											<button type="submit" class="btn btn-primary"><i class="bi bi-search-heart-fill"></i> Cari</button>
										</form>
									</div>
								</div>

								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Hasil Pencarian</h3>
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
									<div class="card-body">
										<?php
										if(isset($_GET['search'])){
											if(count($cariPeserta) > 0){
												echo '<table class="table table-striped" role="table">
													<thead>
														<tr>
															<th>No</th>
															<th>NIP</th>
															<th>Nama Lengkap</th>
															<th>Jurusan</th>
															<th>Kelas</th>
															<th>Jenis Lomba</th>
															<th>Telp</th>
															<th>Email</th>
															<th class="text-center">Status</th>
															<th class="text-center">Aksi</th>
														</tr>
													</thead>
													<tbody>';
													foreach ($cariPeserta as $index => $row){
														if($row['status'] == 1){
															$row['status'] = '<span class="badge bg-success">Aktif</span>';
														} elseif($row['status'] == 2){
															$row['status'] = '<span class="badge bg-danger">Tidak Aktif</span>';
														} elseif($row['status'] == 3){
															$row['status'] = '<span class="badge bg-warning text-dark">Cuti</span>';
														} elseif($row['status'] == 4){
															$row['status'] = '<span class="badge bg-primary">Lulus</span>';
														}

														echo '<tr class="align-middle">
															<td>'.($index + 1).'</td>
															<td>'.$row['nip'].'</td>
															<td>'.$row['nama'].'</td>
															<td>'.$row['jurusan'].'</td>
															<td>'.$row['kelas'].'</td>
															<td>'.$row['lomba'].'</td>
															<td>'.$row['telp'].'</td>
															<td>'.$row['email'].'</td>
															<td class="text-center">'.$row['status'].'</td>
															<td class="text-center">
																<button type="button" class="btn btn-sm btn-warning me-1" onclick="window.location.href=\'data-edit.php?id='.$row['id'].'\'"><i class="bi bi-pencil-fill"></i> Edit</button>
																<button type="button" class="btn btn-sm btn-danger" onclick="if(confirm(\'Yakin ingin menghapus data peserta ini?\')){window.location.href=\'proses/proses-delete.php?id='.$row['id'].'\'}"><i class="bi bi-trash-fill"></i> Hapus</button>
															</td>
														</tr>';
													}
												echo '</tbody></table>';
											} else {
												echo '<div class="alert alert-warning" role="alert">
													Tidak ditemukan data peserta yang sesuai dengan kata kunci "<strong>'.htmlspecialchars($_GET['search']).'</strong>".
												</div>';
											}
										} else {
											echo '<div class="alert alert-info" role="alert">
												Silakan masukkan kata kunci pencarian di atas untuk mencari data peserta.
											</div>';
										}
										?>
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
