<div class="kotak">
    <br>
    <center>
        <h1 class=" text-muted">LAPORAN KISEL SELISIH</h1>
    </center>
    <ul class="nav nav-pills nav-pills" role="tablist">
        <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#harian">Hari</a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#periode">Periode</a></li>
    </ul>

    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active show" id="harian"><br />
            <form action="<?= base_url('p/harian_supplier_kisel_selisih'); ?>" method="POST">
                <div class="form-group">
                    <input class="form-control" type="date" name="tanggal" id="tanggal" value="<?= date('Y-m-d'); ?>" required="">
                </div>
                <button type="submit" class="btn btn-primary btn-neutral">LIHAT LAPORAN</button>
            </form>
        </div>
        <div class="tab-pane fade" id="periode"><br />
            <form action="<?= base_url('p/periode_supplier_kisel_selisih'); ?>" method="POST">
                <div class="form-group">
                    <label for="tgl_mulai">Mulai</label>
                    <input class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" value="<?php $bulan = mktime(0, 0, 0, date('m') - 1, date('d'), date('Y'));
                                                                                                    echo date('Y-m-d', $bulan); ?>" prequired="">
                </div>
                <div class="form-group">
                    <label for="tgl_sampai">Sampai</label>
                    <input class="form-control" type="date" name="tgl_sampai" id="tgl_sampai" value="<?= date('Y-m-d'); ?>" required="">
                </div>
                <button type="submit" class="btn btn-primary btn-neutral">LIHAT LAPORAN</button>
            </form>
        </div>
    </div>
    <br />
</div>