<div class=" kotak animated slideInDown" style="z-index:1-9999; display:inline-block">
	<br>
	<center>
		<h1 class=" text-muted">LAPORAN PERIODE</h1>
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