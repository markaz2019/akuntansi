<div class="kotak">
	<?php if (empty($tgl_mulai) && !empty($tgl_sampai) && !empty($result)) { ?>
		<div class="alert alert-dismissible alert-warning">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<p class="mb-0">Tanggal periode belum ditentukan dengan benar</p>
		</div>

	<?php } else if (empty($tgl_mulai) && !empty($tgl_sampai) && empty($result)) { ?>
		<div class="alert alert-dismissible alert-warning">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<p class="mb-0">Tanggal periode belum ditentukan dengan benar</p>
		</div>

	<?php } else if (!empty($tgl_mulai) && empty($tgl_sampai) && empty($result)) { ?>
		<div class="alert alert-dismissible alert-warning">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<p class="mb-0">Tanggal periode belum ditentukan dengan benar</p>
		</div>

	<?php } else if (empty($tgl_mulai) && empty($tgl_sampai) && empty($result)) { ?>
		<div class="alert alert-dismissible alert-warning">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<p class="mb-0">Tanggal periode belum ditentukan dengan benar</p>
		</div>

	<?php } else if (!empty($tgl_mulai) && !empty($tgl_sampai) && empty($result)) { ?>

		<br>
		<center>
			<h1 class=" text-muted">LAPORAN PERIODE</h1>
		</center>
		<p>Tanggal <strong><?= date('d/m/Y', strtotime($tgl_mulai)); ?></strong> s.d <strong><?= date('d/m/Y', strtotime($tgl_sampai)); ?></strong></p>
		<div class="search-button">
			<a href="#" class="search-toggle" data-selector="#header-table"></a>
		</div>
		<form action="" class="search-box btn-neutral " style="float:right;">
			<input type="text" class="text search-input" placeholder="Search results..." id="myInput">
		</form>
		<table id="tabela1" class="table" width="100%" tabindex="0" aria-label="results">
			<thead>
				<tr>
					<th scope="col">Tanggal</th>
					<th scope="col">Modul</th>
					<th scope="col">Jumlah TRX</th>
					<th scope="col">Saldo Awal</th>
					<th scope="col">Deposit</th>
					<th scope="col">Pemakaian</th>
					<th scope="col">Saldo_akhir_cs</th>
					<th scope="col">Selisih</th>
					<th scope="col">Jenis</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="6" align="center">Tidak ada data</td>
				</tr>
			</tbody>
		</table>
	<?php } else if (!empty($tgl_mulai) && !empty($tgl_sampai) && !empty($result)) { ?>

		<br>
		<center>
			<h1 class=" text-muted">LAPORAN PERIODE</h1>
		</center>
		<p>Tanggal <strong><?= date('d/m/Y', strtotime($tgl_mulai)); ?></strong> s.d <strong><?= date('d/m/Y', strtotime($tgl_sampai)); ?></strong></p>
		<div class="search-button">
			<a href="#" class="search-toggle" data-selector="#header-table"></a>
		</div>
		<form action="" class="search-box btn-neutral " style="float:right;">
			<input type="text" class="text search-input" placeholder="Search results..." id="myInput">
		</form>
		<table id="tabel" class="table" width="100%" tabindex="0" aria-label="results">
			<thead>
				<tr>
					<th scope="col">Tanggal</th>
					<th scope="col">Modul</th>
					<th scope="col">Jumlah TRX</th>
					<th scope="col">Saldo Awal</th>
					<th scope="col">Deposit</th>
					<th scope="col">Pemakaian</th>
					<th scope="col">Saldo_akhir_cs</th>
					<th scope="col">Selisih</th>
					<th scope="col">Jenis</th>
					<th scope="col">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($result as $data) { ?>
					<tr>
						<td><?= date('d/m/Y', strtotime($data->tanggal)); ?></td>
						<td><?= $data->modul; ?></td>
						<td>Rp <?= number_format($data->jml_trx, 2, ',', '.'); ?></td>
						<td>Rp <?= number_format($data->saldo_awal, 2, ',', '.'); ?></td>
						<td>Rp <?= number_format($data->deposit, 2, ',', '.'); ?></td>
						<td>Rp <?= number_format($data->pemakaian, 2, ',', '.'); ?></td>
						<td>Rp <?= number_format($data->saldo_akhir_cs, 2, ',', '.'); ?></td>
						<td>Rp <?= number_format($data->selisih, 2, ',', '.'); ?></td>
						<td><?= $data->jenis; ?></td>
						<?php
								if ($data->jenis == 'masuk') {
									$uri = 'pemasukan';
								} else {
									$uri = 'pengeluaran';
								}
								?>
						<!-- <td>
							<a href="<?= base_url('p/ubah_' . $uri . '/' . $data->nomor); ?>"><span class="badge badge-pill badge-primary">Ubah</span></a> &nbsp;
							<a href="<?= base_url('p/hapus_' . $uri . '/' . $data->nomor); ?>"><span class="badge badge-pill badge-danger">Hapus</span></a>
						</td> -->
					</tr>
				<?php } ?>
			</tbody>
			<thead>
				<?php
					error_reporting(0);
					foreach ($ttl_masuk as $total_masuk) {
						$jumlah_masuk += $total_masuk->jumlah;
					}
					foreach ($ttl_keluar as $total_keluar) {
						$jumlah_keluar += $total_keluar->jumlah;
					}
					$jumlah = $jumlah_masuk - $jumlah_keluar;
					?>
				<tr>
					<th colspan="4" scope="col">
						<h4 class=" text-muted">TOTAL <small>(Pemasukan dan Pengeluaran Tanggal <?= date('d/m/Y', strtotime($tgl_mulai)); ?> s.d <?= date('d/m/Y', strtotime($tgl_sampai)); ?>)</h4></small>
					</th>
					<th scope="col">
						<h4 class=" text-muted">Rp. <?= number_format($jumlah, 2, ',', '.'); ?></h4>
					</th>
					<th scope="col">&nbsp;</th>
				</tr>
			</thead>
		</table>
	<?php
	}
	?>
</div>