<div class=" kotak animated slideInDown" style="z-index:1">
	<br>
	<center>
		<h1 class=" text-muted">LAPORAN HARIAN</h1>
	</center>
	<p>Tanggal <strong><?= date('d/m/Y', strtotime($tanggal)); ?></strong></p>

	<table id="example" class="table table-striped table-bordered table-hover" style="width:100%">
		<thead>
			<tr>
				<th>No</th>
				<th scope="col">Deposit</th>
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
		<thead>
			<tr>
				<th scope="col" style="display:inline-block">Stock Awal</th>
				<th scope="col" style="display:inline-block">Deposit</th>
				<th scope="col" style="display:inline-block">Pemakaian</th>
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