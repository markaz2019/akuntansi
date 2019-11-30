
	<?php if (!empty($cari) && empty($result)) { ?>
		
		<h4>Hasil Pencarian</h4>
		<p>Kata Kunci <strong><?=ucwords($cari);?></strong></p>
		<table class="table table-hover">
			<thead>
				<tr>
				<th scope="col">Nomor</th>
				<th scope="col">Tanggal</th>
				<th scope="col">Modul</th>
				<th scope="col">Jumlah TRX</th>
				<th scope="col">Saldo Awal</th>
				<th scope="col">Deposit</th>
				<th scope="col">Pemakaian</th>
				<th scope="col">Saldo Akhir</th>
				<th scope="col">Saldo_akhir_cs</th>
				<th scope="col">Selisih</th>
				<th scope="col">Jenis</th>
				<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="5" align="center">Tidak ada data</td>
				</tr>
			</tbody>
		</table>
	<?php } else if (!empty($cari) && !empty($result)) { ?>
		
		<h4>Hasil Pencarian</h4>
		<p>Kata Kunci <strong><?=ucwords($cari);?></strong></p>
		<table class="table table-hover">
			<thead>
				<tr>
				<th scope="col">Nomor</th>
				<th scope="col">Tanggal</th>
				<th scope="col">Modul</th>
				<th scope="col">Jumlah TRX</th>
				<th scope="col">Saldo Awal</th>
				<th scope="col">Deposit</th>
				<th scope="col">Pemakaian</th>
				<th scope="col">Saldo Akhir</th>
				<th scope="col">Saldo_akhir_cs</th>
				<th scope="col">Selisih</th>
				<th scope="col">Jenis</th>
				<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($result as $data) { ?>
				<tr>
				<td><?=$data->nomor;?></td>
				<td><?=date('d/m/Y', strtotime($data->tanggal));?></td>
				<td><?=$data->modul;?></td>
				<td>Rp <?=number_format($data->jml_trx,2,',','.');?></td>
				<td>Rp <?=number_format($data->saldo_awal,2,',','.');?></td>
				<td>Rp <?=number_format($data->deposit,2,',','.');?></td>
				<td>Rp <?=number_format($data->pemakaian,2,',','.');?></td>
				<td>Rp <?=number_format($data->saldo_akhir,2,',','.');?></td>
				<td>Rp <?=number_format($data->saldo_akhir_cs,2,',','.');?></td>
				<td>Rp <?=number_format($data->jml_trx + $data->deposit,2,',','.');?></td>
				<td><?=$data->jenis;?></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
		<?=$halaman;?>
	<?php } ?>
