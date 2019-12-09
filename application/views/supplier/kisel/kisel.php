<div class="kotak">
    <br>
    <div id="notifications"><?php echo $this->session->flashdata('msg'); ?></div>
    <br>
    <center>
        <h1 class=" text-muted">PERHITUNGAN KISEL</h1>
    </center>
    <form name='kisel_sum' action="<?= base_url('p/tambah_kisel'); ?>" method="POST">
        <table id="table" class="table table-striped table-bordered table-hover" style="width:100%">
            <thead>
                <tr>
                    <th></th>
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
                    <th class="hidden">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        STOCK AWAL
                        <input type="hidden" class="form-control" name="id_stockawal" id="id_stockawal">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="stockawal10" id="stockawal10" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="stockawal15" id="stockawal15" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="stockawal25" id="stockawal25" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="stockawal30" id="stockawal30" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="stockawal40" id="stockawal40" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="stockawal50" id="stockawal50" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="stockawal75" id="stockawal75" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="stockawal100" id="stockawal100" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="stockawal105" id="stockawal105" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="stockawal200" id="stockawal200" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="stockawal300" id="stockawal300" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="stockawal500" id="stockawal500" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="stockawal1000" id="stockawal1000" value="0" readonly="">
                    </td>
                    <td class="hidden">
                        <input readonly class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" value="<?php $bulan = mktime(0, 0, 0, date('m') - 1, date('d'), date('Y'));
                                                                                                                echo date('Y-m-d', $bulan); ?>" prequired="">
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>DEPOSIT
                        <input type="hidden" class="form-control" name="id_deposit" id="id_deposit">
                        <input type="hidden" class="form-control" name="id_pemakaian" id="id_pemakaian">
                        <input type="hidden" class="form-control" name="id_stockakhir" id="id_stockakhir">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="d_sepuluh" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#d_sepuluh">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="d_lima_belas" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#d_lima_belas">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="d_dua_lima" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#d_dua_lima">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="d_tiga_puluh" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#d_tiga_puluh">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="d_empat_puluh" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#d_empat_puluh">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="d_lima_puluh" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#d_lima_puluh">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="d_tujuh_lima" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#d_tujuh_lima">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="d_seratus" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#d_seratus">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="d_seratus_lima" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#d_seratus_lima">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="d_dua_ratus" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#d_dua_ratus">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="d_tiga_ratus" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#d_tiga_ratus">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="d_lima_ratus" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#d_lima_ratus">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="d_satu_juta" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#d_satu_juta">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td class="hidden">
                        <input readonly class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" value="<?php $bulan = mktime(0, 0, 0, date('m') - 1, date('d'), date('Y'));
                                                                                                                echo date('Y-m-d', $bulan); ?>" prequired="">
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>
                        PEMAKAIAN
                        <input type="hidden" class="form-control" name="id_pemakaian" id="id_pemakaian">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="sepuluh" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#sepuluh">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="lima_belas" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#lima_belas">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="dua_lima" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#dua_lima">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="tiga_puluh" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#tiga_puluh">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="empat_puluh" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#empat_puluh">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="lima_puluh" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#lima_puluh">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="tujuh_lima" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#tujuh_lima">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="seratus" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#seratus">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="seratus_lima" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#seratus_lima">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="dua_ratus" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#dua_ratus">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="tiga_ratus" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#tiga_ratus">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="lima_ratus" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#lima_ratus">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="satu_juta" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#satu_juta">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td class="hidden">
                        <input readonly class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" value="<?php $bulan = mktime(0, 0, 0, date('m') - 1, date('d'), date('Y'));
                                                                                                                echo date('Y-m-d', $bulan); ?>" prequired="">
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>
                        STOCK AKHIR
                        <input type="hidden" class="form-control" name="id_stokakhir" id="id_stokakhir">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="akhir_1" id="akhir_1" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="akhir_2" id="akhir_2" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="akhir_3" id="akhir_3" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="akhir_4" id="akhir_4" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="akhir_5" id="akhir_5" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="akhir_6" id="akhir_6" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="akhir_7" id="akhir_7" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="akhir_8" id="akhir_8" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="akhir_9" id="akhir_9" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="akhir_10" id="akhir_10" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="akhir_11" id="akhir_11" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="akhir_12" id="akhir_12" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="akhir_13" id="akhir_13" value="0" readonly="">
                    </td>
                    <td class="hidden">
                        <input readonly class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" value="<?php $bulan = mktime(0, 0, 0, date('m') - 1, date('d'), date('Y'));
                                                                                                                echo date('Y-m-d', $bulan); ?>" prequired="">
                    </td>
                </tr>
            </tbody>
        </table>

        <br>
        <center>
            <h1 class=" text-muted">PERHITUNGAN KISEL SELISIH</h1>
        </center>
        <!-- <form name='kisel_selisih_sum' action="<?= base_url('p/tambah_kisel'); ?>" method="POST"> -->
        <table id="table" class="table table-striped table-bordered table-hover" style="width:100%">
            <thead>
                <tr>
                    <th></th>
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
                    <th class="hidden">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>SS CSS
                        <input type="hidden" class="form-control" name="id_cs" id="id_cs">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="s_sepuluh" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#s_sepuluh">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="s_lima_belas" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#s_lima_belas">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="s_dua_lima" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#s_dua_lima">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="s_tiga_puluh" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#s_tiga_puluh">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="s_empat_puluh" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#s_empat_puluh">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="s_lima_puluh" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#s_lima_puluh">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="s_tujuh_lima" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#s_tujuh_lima">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="s_seratus" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#s_seratus">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="s_seratus_lima" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#s_seratus_lima">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="s_dua_ratus" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#s_dua_ratus">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="s_tiga_ratus" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#s_tiga_ratus">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="s_lima_ratus" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#s_lima_ratus">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="s_satu_juta" value="0" readonly="">
                        <button type="button" rel="tooltip" class="btn btn-neutral btn-xs form-control" data-toggle="modal" data-target="#s_satu_juta">
                            <i class="tim-icons icon-pencil"></i>
                        </button>
                    </td>
                    <td class="hidden">
                        <input readonly class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" value="<?php $bulan = mktime(0, 0, 0, date('m') - 1, date('d'), date('Y'));
                                                                                                                echo date('Y-m-d', $bulan); ?>" prequired="">
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>
                        HITUNGAN
                        <input type="hidden" class="form-control" name="id_hitungan" id="id_hitungan">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" id="hitungan1" name="hitungan1" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" id="hitungan2" name="hitungan2" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" id="hitungan3" name="hitungan3" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" id="hitungan4" name="hitungan4" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" id="hitungan5" name="hitungan5" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" id="hitungan6" name="hitungan6" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" id="hitungan7" name="hitungan7" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" id="hitungan8" name="hitungan8" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" id="hitungan9" name="hitungan9" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" id="hitungan10" name="hitungan10" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" id="hitungan11" name="hitungan11" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" id="hitungan12" name="hitungan12" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" id="hitungan13" name="hitungan13" value="0" readonly="">
                    </td>
                    <td class="hidden">
                        <input readonly class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" value="<?php $bulan = mktime(0, 0, 0, date('m') - 1, date('d'), date('Y'));
                                                                                                                echo date('Y-m-d', $bulan); ?>" prequired="">
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr>
                    <td>
                        SELISIH
                        <input type="hidden" class="form-control" name="id_selisih" id="id_selisih">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="selisih_1" id="selisih_1" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="selisih_2" id="selisih_2" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="selisih_3" id="selisih_3" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="selisih_4" id="selisih_4" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="selisih_5" id="selisih_5" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="selisih_6" id="selisih_6" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="selisih_7" id="selisih_7" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="selisih_8" id="selisih_8" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="selisih_9" id="selisih_9" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="selisih_10" id="selisih_10" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="selisih_11" id="selisih_11" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="selisih_12" id="selisih_12" value="0" readonly="">
                    </td>
                    <td style="width:4%">
                        <input class="form-control" type="number" name="selisih_13" id="selisih_13" value="0" readonly="">
                    </td>
                    <td class="hidden">
                        <input readonly class="form-control" type="date" name="tgl_mulai" id="tgl_mulai" value="<?php $bulan = mktime(0, 0, 0, date('m') - 1, date('d'), date('Y'));
                                                                                                                echo date('Y-m-d', $bulan); ?>" prequired="">
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="modal-footer">
            <button type="submit" class="btn btn-neutral">Save</button>
        </div>
    </form>
    <br>
    <br>