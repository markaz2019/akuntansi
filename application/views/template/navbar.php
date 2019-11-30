<br />
<div class="navbar navbar-expand-lg navbar-dark bg-primary">
	<a class="navbar-brand" href="<?= base_url('p/index'); ?>">AKUNTANSI</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" style="">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarColor01">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url('p/laporan'); ?>"><i class="fa fa-line-chart"></i>LAPORAN</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url('p/telkomsel'); ?>"><i class="fa fa-ravelry" aria-hidden="true"></i>TELKOMSEL</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-fx fa-bars" aria-hidden="true"></i>MENU NIRWANA</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="<?= base_url('p/nirwana'); ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i>NIRWANA</a>
					<a class="dropdown-item" href="<?= base_url('p/nirwana_oto'); ?>"><i class="fa fa-bar-chart" aria-hidden="true"></i>NIRWANA OTO</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cubes" aria-hidden="true"></i>
					</i>MENU KISEL</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="<?= base_url('p/kisel'); ?>"><i class="fa fa-cubes" aria-hidden="true"></i>KISEL</a>
					<a class="dropdown-item" href="<?= base_url('p/kisel_selisih'); ?>"><i class="fa fa-cubes" aria-hidden="true"></i>KISEL SELISIH</a>
				</div>
			</li>
		</ul>
		<!-- <form class="form-inline ml-auto" action="<?= base_url('p/cari'); ?>" method="GET">
			<div class="form-group no-border">
				<input name="s" type="text" class="form-search" placeholder="Cari Disini">
				<button class="btn btn-primary btn-neutral" type="submit"><i class="tim-icons icon-double-right"></i></button>
			</div>
		</form> -->
	</div>
</div>
<br />