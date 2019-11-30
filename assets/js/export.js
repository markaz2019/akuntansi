$(document).ready(function () {
    //Only needed for the filename of export files.
    //Normally set in the title tag of your page.document.title = 'Simple DataTable';
    //Define hidden columns
    var hCols = [3, 4];
    // DataTable initialisation
    $('#table').DataTable({
        "dom": "<'row'<'col-sm-4'B><'col-sm-2'l><'col-sm-6'p<br/>i>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-12'p<br/>i>>",
        "paging": true,
        "autoWidth": true,
        "columnDefs": [{
            "visible": false,
            "targets": hCols
        }],
        "buttons": [{
            extend: 'colvis',
            collectionLayout: 'three-column',
            text: function () {
                var totCols = $('#table thead th').length;
                var hiddenCols = hCols.length;
                var shownCols = totCols - hiddenCols;
                return 'Columns (' + shownCols + ' of ' + totCols + ')';
            },
            prefixButtons: [{
                extend: 'colvisGroup',
                text: 'Show all',
                show: ':hidden'
            }, {
                extend: 'colvisRestore',
                text: 'Restore'
            }]
        }, {
            extend: 'collection',
            text: 'Export',
            buttons: [{
                text: 'Excel',
                extend: 'excelHtml5',
                footer: false,
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                text: 'CSV',
                extend: 'csvHtml5',
                fieldSeparator: ';',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                text: 'PDF Portrait',
                extend: 'pdfHtml5',
                message: '',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                text: 'PDF Landscape',
                extend: 'pdfHtml5',
                message: '',
                orientation: 'landscape',
                exportOptions: {
                    columns: ':visible'
                }
            }]
        }],
        oLanguage: {
            oPaginate: {
                sNext: '<span class="pagination-default">&#x276f;</span>',
                sPrevious: '<span class="pagination-default">&#x276e;</span>'
            }
        },
        "initComplete": function (settings, json) {
            // Adjust hidden columns counter text in button -->
            $('#table').on('column-visibility.dt', function (e, settings, column, state) {
                var visCols = $('#table thead tr:first th').length;
                //Below: The minus 2 because of the 2 extra buttons Show all and Restore
                var tblCols = $('.dt-button-collection li[aria-controls=table] a').length - 2;
                $('.buttons-colvis[aria-controls=table] span').html('Columns (' + visCols + ' of ' + tblCols + ')');
                e.stopPropagation();
            });
        }
    });
});