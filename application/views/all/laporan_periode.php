<div class=" kotak animated slideInDown" style="z-index:1-9999; display:inline-block">
	<br>
	<center>
		<h1 class=" text-muted">TELKOMSEL</h1>
	</center>
	<p>Tanggal <strong><?= date('d/m/Y', strtotime($tgl_mulai)); ?></strong> s.d <strong><?= date('d/m/Y', strtotime($tgl_sampai)); ?></strong></p>

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
		</thead>
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
<div class=" kotak animated slideInDown" style="z-index:1-9999; display:inline-block">
	<br>
	<center>
		<h1 class=" text-muted">NIRWANA</h1>
	</center>
	<p>Tanggal <strong><?= date('d/m/Y', strtotime($tgl_mulai)); ?></strong> s.d <strong><?= date('d/m/Y', strtotime($tgl_sampai)); ?></strong></p>

	<table id="example" class="table table-striped table-bordered table-hover" style="width:100%">
		<thead>
			<tr>
				<th scope="col">No</th>
				<th scope="col">Keterangan</th>
				<th scope="col">5K</th>
				<th scope="col">10K</th>
				<th scope="col">Tanggal</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1;
			foreach ($nirwana as $data) { ?>
				<tr>
					<td><?= $i++; ?></td>
					<td><?= $data->ket; ?></td>
					<td>Rp <?= number_format($data->lima, 2, ',', '.'); ?></td>
					<td>Rp <?= number_format($data->sepuluh, 2, ',', '.'); ?></td>
					<td><?= date('d/m/Y', strtotime($data->tanggal)); ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<div class=" kotak animated slideInDown" style="z-index:1-9999; display:inline-block">
	<br>
	<center>
		<h1 class=" text-muted">NIRWANA OTO</h1>
	</center>
	<p>Tanggal <strong><?= date('d/m/Y', strtotime($tgl_mulai)); ?></strong> s.d <strong><?= date('d/m/Y', strtotime($tgl_sampai)); ?></strong></p>

	<table id="example" class="table table-striped table-bordered table-hover" style="width:100%">
		<thead>
			<tr>
				<th scope="col">No</th>
				<th scope="col">Keterangan</th>
				<th scope="col">5K</th>
				<th scope="col">10K</th>
				<th scope="col">Tanggal</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1;
			foreach ($nirwana_oto as $data) { ?>
				<tr>
					<td><?= $i++; ?></td>
					<td><?= $data->ket; ?></td>
					<td>Rp <?= number_format($data->lima, 2, ',', '.'); ?></td>
					<td>Rp <?= number_format($data->sepuluh, 2, ',', '.'); ?></td>
					<td><?= date('d/m/Y', strtotime($data->tanggal)); ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<div class=" kotak animated slideInDown" style="z-index:1-9999; display:inline-block">
	<br>
	<center>
		<h1 class=" text-muted">KISEL</h1>
	</center>
	<p>Tanggal <strong><?= date('d/m/Y', strtotime($tgl_mulai)); ?></strong> s.d <strong><?= date('d/m/Y', strtotime($tgl_sampai)); ?></strong></p>

	<table id="example" class="table table-striped table-bordered table-hover" style="width:100%">
		<thead>
			<tr>
				<th>No</th>
				<th scope="col">Keterangan</th>
				<th scope="col">10K</th>
				<th scope="col">15K</th>
				<th scope="col">25K</th>
				<th scope="col">30K</th>
				<th scope="col">40K</th>
				<th scope="col">50K</th>
				<th scope="col">75K</th>
				<th scope="col">100K</th>
				<th scope="col">105K</th>
				<th scope="col">200K</th>
				<th scope="col">300K</th>
				<th scope="col">500K</th>
				<th scope="col">1000K</th>
				<th scope="col">Tanggal</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1;
			foreach ($kisel as $data) { ?>
				<tr>
					<td><?= $i++ ?></td>
					<td><?= $data->ket; ?></td>
					<td><?= number_format($data->sepuluh); ?></td>
					<td><?= number_format($data->lima_belas); ?></td>
					<td><?= number_format($data->dua_lima); ?></td>
					<td><?= number_format($data->tiga_puluh); ?></td>
					<td><?= number_format($data->empat_puluh); ?></td>
					<td><?= number_format($data->lima_puluh); ?></td>
					<td><?= number_format($data->tujuh_lima); ?></td>
					<td><?= number_format($data->seratus); ?></td>
					<td><?= number_format($data->seratus_lima); ?></td>
					<td><?= number_format($data->dua_ratus); ?></td>
					<td><?= number_format($data->tiga_ratus); ?></td>
					<td><?= number_format($data->lima_ratus); ?></td>
					<td><?= number_format($data->satu_juta); ?></td>
					<td><?= date('d/m/Y', strtotime($data->tanggal)); ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<div class=" kotak animated slideInDown" style="z-index:1-9999; display:inline-block">
	<br>
	<center>
		<h1 class=" text-muted">KISEL SELISIH</h1>
	</center>
	<p>Tanggal <strong><?= date('d/m/Y', strtotime($tgl_mulai)); ?></strong> s.d <strong><?= date('d/m/Y', strtotime($tgl_sampai)); ?></strong></p>

	<table id="example" class="table table-striped table-bordered table-hover" style="width:100%">
		<thead>
			<tr>
				<th>No</th>
				<th scope="col">Keterangan</th>
				<th scope="col">10K</th>
				<th scope="col">15K</th>
				<th scope="col">25K</th>
				<th scope="col">30K</th>
				<th scope="col">40K</th>
				<th scope="col">50K</th>
				<th scope="col">75K</th>
				<th scope="col">100K</th>
				<th scope="col">105K</th>
				<th scope="col">200K</th>
				<th scope="col">300K</th>
				<th scope="col">500K</th>
				<th scope="col">1000K</th>
				<th scope="col">Tanggal</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1;
			foreach ($kisel_selisih as $data) { ?>
				<tr>
					<td><?= $i++ ?></td>
					<td><?= $data->ket; ?></td>
					<td><?= number_format($data->sepuluh); ?></td>
					<td><?= number_format($data->lima_belas); ?></td>
					<td><?= number_format($data->dua_lima); ?></td>
					<td><?= number_format($data->tiga_puluh); ?></td>
					<td><?= number_format($data->empat_puluh); ?></td>
					<td><?= number_format($data->lima_puluh); ?></td>
					<td><?= number_format($data->tujuh_lima); ?></td>
					<td><?= number_format($data->seratus); ?></td>
					<td><?= number_format($data->seratus_lima); ?></td>
					<td><?= number_format($data->dua_ratus); ?></td>
					<td><?= number_format($data->tiga_ratus); ?></td>
					<td><?= number_format($data->lima_ratus); ?></td>
					<td><?= number_format($data->satu_juta); ?></td>
					<td><?= date('d/m/Y', strtotime($data->tanggal)); ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>