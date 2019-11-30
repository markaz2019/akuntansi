</div>

<script rel="stylesheet" href="<?= base_url() . 'assets/demo/style.js' ?>"></script>

<script rel="stylesheet" href="<?= base_url() . 'assets/js/style.js' ?>"></script>
<script rel="stylesheet" href="<?= base_url() . 'assets/js/style.js.map' ?>"></script>
<script rel="stylesheet" href="<?= base_url() . 'assets/js/style.min.js' ?>"></script>

<script rel="stylesheet" href="<?= base_url() . 'assets/js/plugins/bootstrap-datepicker.js' ?>"></script>
<script rel="stylesheet" href="<?= base_url() . 'assets/js/plugins/bootstrap-datetimepicker.js' ?>"></script>
<script rel="stylesheet" href="<?= base_url() . 'assets/js/plugins/bootstrap-switch.js' ?>"></script>
<script rel="stylesheet" href="<?= base_url() . 'assets/js/plugins/chartjs.min.js' ?>"></script>
<script rel="stylesheet" href="<?= base_url() . 'assets/js/plugins/jquery.sharrre.min.js' ?>"></script>
<script rel="stylesheet" href="<?= base_url() . 'assets/js/plugins/moment.min.js' ?>"></script>
<script rel="stylesheet" href="<?= base_url() . 'assets/js/plugins/nouislider.min.js' ?>"></script>
<script rel="stylesheet" href="<?= base_url() . 'assets/js/plugins/perfect-scrollbar.jquery.min.js' ?>"></script>

<script rel="stylesheet" href="<?= base_url() . 'assets/js/core/bootstrap.min.js' ?>"></script>
<script rel="stylesheet" href="<?= base_url() . 'assets/js/core/jquery.min.js' ?>"></script>
<script rel="stylesheet" href="<?= base_url() . 'assets/js/core/popper.min.js' ?>"></script>

<script rel="stylesheet" href="<?= base_url() . 'assets/js/table.js' ?>"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src='https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js'></script>

<script src="https://use.fontawesome.com/6771052f87.js"></script>

<script>
    //datatable
    $(document).ready(function() {
        $('#tabel').DataTable({
            "searching": false // false to disable search (or any other option)
        });
        $('.dataTables_length').addClass('bs-select');
    });

    //search form table toggle
    $('.table-responsive').on('click', '.search-toggle', function(e) {
        var selector = $(this).data('selector');

        $(selector).toggleClass('show').find('.search-input').focus();
        $(this).toggleClass('active');

        e.preventDefault();
    });

    //filter input for table 
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tabel tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
</script>
</body>

</html>