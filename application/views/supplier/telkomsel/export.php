<div class=" kotak animated slideInDown" style="z-index:1">
    <?php if (empty($tanggal) && empty($result)) { ?>
        <div class="alert alert-dismissible alert-warning">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p class="mb-0">Tanggal harian belum ditentukan</p>
        </div>
    <?php } else if (!empty($tanggal) && empty($result)) { ?>
        <br>
        <center>
            <h1 class=" text-muted">LAPORAN HARIAN</h1>
            <form method="post" action="<?php echo base_url('Export/export') ?>">
                <button class="btn btn-success">Export </button>
            </form>
        </center>
        <p>Tanggal <strong><?= $tanggal; ?></strong></p>
        <form class="form-inline ml-auto">
            <div class="form-group ">
                <input type="text" class="form-control" placeholder="Search" id="myInput">
            </div>
        </form>
        <table id="tabel" class="table" width="100%" tabindex="0" aria-label="results" style="z-index:1">
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
                <tr>
                    <td colspan="12" align="center">Tidak ada data</td>
                </tr>
            </tbody>
        </table>
    <?php } else if (!empty($tanggal) && !empty($result)) { ?>
        <br>
        <center>
            <h1 class=" text-muted">LAPORAN HARIAN</h1>
            <button class="btn btn-success">Export </button>

        </center>
        <p>Tanggal <strong><?= date('d/m/Y', strtotime($tanggal)); ?></strong></p>
        <form class="form-inline ml-auto">
            <div class="form-group ">
                <input type="text" class="form-control" placeholder="Search" id="myInput">
            </div>
        </form><br>
        <table id="tabel" class="table" width="100%" tabindex="0" aria-label="results">
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
                    <th>

                    </th>
                    <th>
                        <h4 class=" text-muted">Total</h4>
                    </th>
                    <th></th>
                    <th>
                        <h4 class=" text-muted">Rp. <?= number_format($jumlah_trx, 2, ',', '.'); ?></h4>
                    </th>
                    <th>
                        <h4 class=" text-muted">Rp. <?= number_format($jumlah_spl, 2, ',', '.'); ?></h4>
                    </th>
                    <th>
                        <h4 class=" text-muted">Rp. <?= number_format($jumlah_selisih_trx, 2, ',', '.'); ?></h4>
                    </th>
                    <th>
                        <h4 class=" text-muted">Rp. <?= number_format($Jumlah_saldo_awal, 2, ',', '.'); ?></h4>
                    </th>
                    <th>
                        <h4 class=" text-muted">Rp. <?= number_format($jumlah_deposit, 2, ',', '.'); ?></h4>
                    </th>
                    <th>
                        <h4 class=" text-muted">Rp. <?= number_format($jumlah_pemakaian, 2, ',', '.'); ?></h4>
                    </th>
                    <th>
                        <h4 class=" text-muted">Rp. <?= number_format($jumlah_saldo_akhir_cs, 2, ',', '.'); ?></h4>
                    </th>
                    <th>
                        <h4 class=" text-muted">Rp. <?= number_format($jumlah_selisih_akhir, 2, ',', '.'); ?></h4>
                    </th>
                </tr>
            </thead>
        </table>
    <?php
    }
    ?>
</div>