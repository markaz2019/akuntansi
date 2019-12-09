<script>
    function hitungan() {
        interval = setInterval("hitung()", 1);
    }

    function hitung() {

        // MEMANGGIL PERHITUNGAN KISEL
        hitung1 = document.kisel_sum.d_sepuluh.value;
        hitung2 = document.kisel_sum.sepuluh.value;
        document.kisel_sum.hitungan1.value = (hitung1 * 1) + (hitung2 * 1);

        hitung1_2 = document.kisel_sum.d_lima_belas.value;
        hitung2_2 = document.kisel_sum.lima_belas.value;
        document.kisel_sum.hitungan2.value = (hitung1_2 * 1) + (hitung2_2 * 1);

        hitung1_3 = document.kisel_sum.d_dua_lima.value;
        hitung2_3 = document.kisel_sum.dua_lima.value;
        document.kisel_sum.hitungan3.value = (hitung1_3 * 1) + (hitung2_3 * 1);

        hitung1_4 = document.kisel_sum.d_tiga_puluh.value;
        hitung2_4 = document.kisel_sum.tiga_puluh.value;
        document.kisel_sum.hitungan4.value = (hitung1_4 * 1) + (hitung2_4 * 1);

        hitung1_5 = document.kisel_sum.d_empat_puluh.value;
        hitung2_5 = document.kisel_sum.empat_puluh.value;
        document.kisel_sum.hitungan5.value = (hitung1_5 * 1) + (hitung2_5 * 1);

        hitung1_6 = document.kisel_sum.d_lima_puluh.value;
        hitung2_6 = document.kisel_sum.lima_puluh.value;
        document.kisel_sum.hitungan6.value = (hitung1_6 * 1) + (hitung2_6 * 1);

        hitung1_7 = document.kisel_sum.d_tujuh_lima.value;
        hitung2_7 = document.kisel_sum.tujuh_lima.value;
        document.kisel_sum.hitungan7.value = (hitung1_7 * 1) + (hitung2_7 * 1);

        hitung1_8 = document.kisel_sum.d_seratus.value;
        hitung2_8 = document.kisel_sum.seratus.value;
        document.kisel_sum.hitungan8.value = (hitung1_8 * 1) + (hitung2_8 * 1);

        hitung1_9 = document.kisel_sum.d_seratus_lima.value;
        hitung2_9 = document.kisel_sum.seratus_lima.value;
        document.kisel_sum.hitungan9.value = (hitung1_9 * 1) + (hitung2_9 * 1);

        hitung1_10 = document.kisel_sum.d_dua_ratus.value;
        hitung2_10 = document.kisel_sum.dua_ratus.value;
        document.kisel_sum.hitungan10.value = (hitung1_10 * 1) + (hitung2_10 * 1);

        hitung1_11 = document.kisel_sum.d_tiga_ratus.value;
        hitung2_11 = document.kisel_sum.tiga_ratus.value;
        document.kisel_sum.hitungan11.value = (hitung1_11 * 1) + (hitung2_11 * 1);

        hitung1_12 = document.kisel_sum.d_lima_ratus.value;
        hitung2_12 = document.kisel_sum.lima_ratus.value;
        document.kisel_sum.hitungan12.value = (hitung1_12 * 1) + (hitung2_12 * 1);

        hitung1_13 = document.kisel_sum.d_satu_juta.value;
        hitung2_13 = document.kisel_sum.satu_juta.value;
        document.kisel_sum.hitungan13.value = (hitung1_13 * 1) + (hitung2_13 * 1);



        // MENCARI KISEL SELISIH

        selisih_1 = document.kisel_sum.s_sepuluh.value;
        selisih_2 = document.kisel_sum.hitungan1.value;
        document.kisel_sum.selisih_1.value = (selisih_1 * 1) - (selisih_2 * 1);

        selisih1_2 = document.kisel_sum.s_lima_belas.value;
        selisih2_2 = document.kisel_sum.hitungan2.value;
        document.kisel_sum.selisih_2.value = (selisih1_2 * 1) - (selisih2_2 * 1);

        selisih1_3 = document.kisel_sum.s_dua_lima.value;
        selisih2_3 = document.kisel_sum.hitungan3.value;
        document.kisel_sum.selisih_3.value = (selisih1_3 * 1) - (selisih2_3 * 1);

        selisih1_4 = document.kisel_sum.s_tiga_puluh.value;
        selisih2_4 = document.kisel_sum.hitungan4.value;
        document.kisel_sum.selisih_4.value = (selisih1_4 * 1) - (selisih2_4 * 1);

        selisih1_5 = document.kisel_sum.s_empat_puluh.value;
        selisih2_5 = document.kisel_sum.hitungan5.value;
        document.kisel_sum.selisih_5.value = (selisih1_5 * 1) - (selisih2_5 * 1);

        selisih1_6 = document.kisel_sum.s_lima_puluh.value;
        selisih2_6 = document.kisel_sum.hitungan6.value;
        document.kisel_sum.selisih_6.value = (selisih1_6 * 1) - (selisih2_6 * 1);

        selisih1_7 = document.kisel_sum.s_tujuh_lima.value;
        selisih2_7 = document.kisel_sum.hitungan7.value;
        document.kisel_sum.selisih_7.value = (selisih1_7 * 1) - (selisih2_7 * 1);

        selisih1_8 = document.kisel_sum.s_seratus.value;
        selisih2_8 = document.kisel_sum.hitungan8.value;
        document.kisel_sum.selisih_8.value = (selisih1_8 * 1) - (selisih2_8 * 1);

        selisih1_9 = document.kisel_sum.s_seratus_lima.value;
        selisih2_9 = document.kisel_sum.hitungan9.value;
        document.kisel_sum.selisih_9.value = (selisih1_9 * 1) - (selisih2_9 * 1);

        selisih1_10 = document.kisel_sum.s_dua_ratus.value;
        selisih2_10 = document.kisel_sum.hitungan10.value;
        document.kisel_sum.selisih_10.value = (selisih1_10 * 1) - (selisih2_10 * 1);

        selisih1_11 = document.kisel_sum.s_tiga_ratus.value;
        selisih2_11 = document.kisel_sum.hitungan11.value;
        document.kisel_sum.selisih_11.value = (selisih1_11 * 1) - (selisih2_11 * 1);

        selisih1_12 = document.kisel_sum.s_lima_ratus.value;
        selisih2_12 = document.kisel_sum.hitungan12.value;
        document.kisel_sum.selisih_12.value = (selisih1_12 * 1) - (selisih2_12 * 1);

        selisih1_13 = document.kisel_sum.s_satu_juta.value;
        selisih2_13 = document.kisel_sum.hitungan13.value;
        document.kisel_sum.selisih_13.value = (selisih1_13 * 1) - (selisih2_13 * 1);


    }

    function stop_hitung() {
        clearInterval(interval);
    }
</script>