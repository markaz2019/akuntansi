<body>
    <a href="<?php echo base_url('export'); ?>">Export report</a>
    <table border="1" cellspacing="0">
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
            <?php $index = 1; ?>
            <?php foreach ($report as $report) : ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $report->modul_id; ?></td>
                    <td><?= $report->modul; ?></td>
                    <td>Rp <?= number_format($report->jml_trx, 2, ',', '.'); ?></td>
                    <td>Rp <?= number_format($report->spl, 2, ',', '.'); ?></td>
                    <td>Rp <?= number_format($report->jml_trx + $report->spl, 2, ',', '.'); ?></td>
                    <td>Rp <?= number_format($report->saldo_awal, 2, ',', '.'); ?></td>
                    <td>Rp <?= number_format($report->deposit, 2, ',', '.'); ?></td>
                    <td>Rp <?= number_format($report->pemakaian, 2, ',', '.'); ?></td>
                    <td>Rp <?= number_format($report->saldo_akhir_cs, 2, ',', '.'); ?></td>
                    <td>Rp <?= number_format($report->saldo_akhir_cs + $report->pemakaian - $report->deposit - $report->saldo_awal, 2, ',', '.'); ?></td>
                    <td><?= $report->jenis; ?></td>
                <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>