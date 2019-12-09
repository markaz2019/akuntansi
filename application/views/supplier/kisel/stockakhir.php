<script>
    function akhir() {
        interval = setInterval("s_akhir()", 1);
    }

    function s_akhir() {
        final1 = document.kisel_sum.d_sepuluh.value;
        final2 = document.kisel_sum.sepuluh.value;
        document.kisel_sum.akhir_1.value = (final1 * 1) + (final2 * 1);

        final1_2 = document.kisel_sum.d_lima_belas.value;
        final2_2 = document.kisel_sum.lima_belas.value;
        document.kisel_sum.akhir_2.value = (final1_2 * 1) + (final2_2 * 1);

        final1_3 = document.kisel_sum.d_dua_lima.value;
        final2_3 = document.kisel_sum.dua_lima.value;
        document.kisel_sum.akhir_3.value = (final1_3 * 1) + (final2_3 * 1);

        final1_4 = document.kisel_sum.d_tiga_puluh.value;
        final2_4 = document.kisel_sum.tiga_puluh.value;
        document.kisel_sum.akhir_4.value = (final1_4 * 1) + (final2_4 * 1);

        final1_5 = document.kisel_sum.d_empat_puluh.value;
        final2_5 = document.kisel_sum.empat_puluh.value;
        document.kisel_sum.akhir_5.value = (final1_5 * 1) + (final2_5 * 1);

        final1_6 = document.kisel_sum.d_lima_puluh.value;
        final2_6 = document.kisel_sum.lima_puluh.value;
        document.kisel_sum.akhir_6.value = (final1_6 * 1) + (final2_6 * 1);

        final1_7 = document.kisel_sum.d_tujuh_lima.value;
        final2_7 = document.kisel_sum.tujuh_lima.value;
        document.kisel_sum.akhir_7.value = (final1_7 * 1) + (final2_7 * 1);

        final1_8 = document.kisel_sum.d_seratus.value;
        final2_8 = document.kisel_sum.seratus.value;
        document.kisel_sum.akhir_8.value = (final1_8 * 1) + (final2_8 * 1);

        final1_9 = document.kisel_sum.d_seratus_lima.value;
        final2_9 = document.kisel_sum.seratus_lima.value;
        document.kisel_sum.akhir_9.value = (final1_9 * 1) + (final2_9 * 1);

        final1_10 = document.kisel_sum.d_dua_ratus.value;
        final2_10 = document.kisel_sum.dua_ratus.value;
        document.kisel_sum.akhir_10.value = (final1_10 * 1) + (final2_10 * 1);

        final1_11 = document.kisel_sum.d_tiga_ratus.value;
        final2_11 = document.kisel_sum.tiga_ratus.value;
        document.kisel_sum.akhir_11.value = (final1_11 * 1) + (final2_11 * 1);

        final1_12 = document.kisel_sum.d_lima_ratus.value;
        final2_12 = document.kisel_sum.lima_ratus.value;
        document.kisel_sum.akhir_12.value = (final1_12 * 1) + (final2_12 * 1);

        final1_13 = document.kisel_sum.d_satu_juta.value;
        final2_13 = document.kisel_sum.satu_juta.value;
        document.kisel_sum.akhir_13.value = (final1_13 * 1) + (final2_13 * 1);

    }

    function endstock() {
        clearInterval(interval);
    }
</script>