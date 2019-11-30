
<h4>Ubah Pemasukan</h4>
<?php if ($this->session->flashdata('message')) { ?>
	<div class="alert alert-dismissible alert-danger">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<p class="mb-0"><?php echo $this->session->flashdata('message');?></p>
	</div>
<?php } ?>
<form action="<?=base_url('p/update_pemasukan');?>" method="POST">
	<div class="form-group">
		<label class="col-form-label" for="nomor">Nomor</label>
		<input type="number" class="form-control" name="nomor" id="nomor" value="<?=$nomor;?>" readonly="">
	</div>
	<div class="form-group">
		<label class="col-form-label" for="modul">modul</label>
		<textarea class="form-control" name="modul" id="modul" placeholder="modul" required=""><?=$modul;?></textarea>
	</div>
<div class="form-group">
		<label class="col-form-label" for="tanggal">Tanggal</label>
		<input type="date" class="form-control" name="tanggal" id="tanggal"  value="<?=$tanggal;?>" required="">
	</div>
	<div class="form-group">
		<label class="col-form-label" for="jml_trx">Jumlah TRX</label>
		<input type="number" class="form-control" name="jml_trx" id="jml_trx" placeholder="jml_trx" value="<?=$jml_trx;?>" required="">
	</div>

		<div class="form-group">
		<label class="col-form-label" for="saldo_awal">Saldo Awal</label>
		<input type="number" class="form-control" name="saldo_awal" id="saldo_awal" placeholder="saldo_awal" value="<?=$saldo_awal;?>" required="">
	</div>
		<div class="form-group">
		<label class="col-form-label" for="deposit">deposit</label>
		<input type="number" class="form-control" name="deposit" id="deposit" placeholder="deposit" value="<?=$deposit;?>" required="">
	
	</div>
		<div class="form-group">
		<label class="col-form-label" for="saldo_akhir">Saldo akhir</label>
		<input type="number" class="form-control" name="saldo_akhir" id="saldo_akhir" placeholder="saldo_akhir" value="<?=$saldo_akhir;?>" required="">
	</div>
			<div class="form-group">
		<label class="col-form-label" for="saldo_akhir_cs">Saldo akhir CS</label>
		<input type="number" class="form-control" name="saldo_akhir_cs" id="saldo_akhir_cs" placeholder="saldo_akhir_cs" value="<?=$saldo_akhir_cs;?>" required="">
	</div>
				<div class="form-group">
		<label class="col-form-label" for="selisih">selisih</label>
		<input type="number" class="form-control" name="selisih" id="selisih" placeholder="selisih" value="<?=$selisih;?>" required="">
	</div>
				
	<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
</form>

