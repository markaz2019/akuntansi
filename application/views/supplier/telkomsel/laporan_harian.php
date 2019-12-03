<div class=" kotak animated slideInDown" style="z-index:1">
	<br>
	<center>
		<h1 class=" text-muted">LAPORAN HARIAN</h1>
		<form method="post" action="<?php echo base_url('Export/export') ?>">
			<button class="btn btn-success">Export </button>
			<button class="btn btn-success">Print</button>
		</form>
	</center>
	<p><strong><?= date('d/m/Y', strtotime($tanggal)); ?></strong></p>
	<table id="example" class="table table-striped table-bordered table-hover" style="width:100%">
		<thead>
			<tr>
				<th>No</th>
				<th scope="col">Modul ID</th>
				<th scope="col">Modul</th>
				<th scope="col">Jumlah TRX</th>
				<th scope="col">SPL</th>
				<th scope="col">Selisih Transaksi</th>
				<th scope="col">Saldo Awal</th>
				<th scope="col">Deposit</th>
				<th scope="col">Pemakaian</th>
				<th scope="col">Saldo_akhir_cs</th>
				<th scope="col">Selisih Akhir</th>
				<th scope="col">Jenis</th>
				<th scope="col">Tanggal</th>
			</tr>
		</thead>.
		<tbody>
			<?php $i = 1;
			foreach ($result as $data) { ?>
				<tr>
					<td><?= $i++ ?></td>
					<td><?= $data->modul_id; ?></td>
					<td><?= $data->modul; ?></td>
					<td>Rp <?= number_format($data->jml_trx, 2, ',', '.'); ?></td>
					<td>Rp <?= number_format($data->spl, 2, ',', '.'); ?></td>
					<td>Rp <?= number_format($data->jml_trx + $data->spl, 2, ',', '.'); ?></td>
					<td>Rp <?= number_format($data->saldo_awal, 2, ',', '.'); ?></td>
					<td>Rp <?= number_format($data->deposit, 2, ',', '.'); ?></td>
					<td>Rp <?= number_format($data->pemakaian, 2, ',', '.'); ?></td>
					<td>Rp <?= number_format($data->saldo_akhir_cs, 2, ',', '.'); ?></td>
					<td>Rp <?= number_format($data->saldo_akhir_cs + $data->pemakaian - $data->deposit - $data->saldo_awal, 2, ',', '.'); ?></td>
					<td><?= $data->jenis; ?></td>
					<?php
						if ($data->jenis == 'masuk') {
							$uri = 'pemasukan';
						} else {
							$uri = 'pengeluaran';
						}
						?>
					<td><?= date('d/m/Y', strtotime($data->tanggal)); ?></td>
					<!-- <td>
							<a href="<?= base_url('p/ubah_' . $uri . '/' . $data->nomor); ?>"><span class="badge badge-pill badge-primary">Ubah</span></a> &nbsp;
							<a href="<?= base_url('p/hapus_' . $uri . '/' . $data->nomor); ?>"><span class="badge badge-pill badge-danger">Hapus</span></a>
						</td> -->
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>