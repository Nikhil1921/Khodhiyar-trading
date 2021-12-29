var url = $("#base_url").val();
var dataTableUrl = $("#dataTableUrl").val();

var table = $('.datatable').DataTable({
    "pagingType": "full_numbers",
    "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
    ],
    dom: 'Bfrtip',
    buttons: [
        'pageLength',
        {
            extend: 'print',
            footer: true,
            exportOptions: {
                columns: ':visible'
            },
        },
        {
            extend: 'excel',
            footer: true,
            exportOptions: {
                columns: ':visible'
            },
        },
        'colvis'
    ],
    columnDefs: [{
        targets: -1,
        visible: false
    }],
    "processing": true,
    "serverSide": true,
    'language': {
        'loadingRecords': '&nbsp;',
        'processing': 'Processing',
        'paginate': {
            'first': 'First',
            'next': '<i class="fa fa-arrow-circle-right"></i>',
            'previous': '<i class="fa fa-arrow-circle-left"></i>',
            'last': 'Last'
        }
    },
    "order": [],
    "ajax": {
        url: dataTableUrl,
        type: "POST",
        data: function(data) {
            data.start_date = $("input[name=start-date]").val();
            data.end_date = $("input[name=end-date]").val();
        },
        complete: function(response) {},
    },
    "footerCallback": function(row, data, start, end, display) {
        if ($("input[name=rate-total]").length > 0) {
            var api = this.api(),
                data;
            // Remove the formatting to get integer data for summation
            var intVal = function(i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                    i : 0;
            };

            // Total over this page
            pageTotal = api
                .column(3, { page: 'current' })
                .data()
                .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(3).footer()).html(
                pageTotal
            );
        }
    },
    "columnDefs": [{
        "targets": "target",
        "orderable": false,
    }, ]
});

$('#date-filter').change(function() {
    table.ajax.reload();
});

$('.reload-data').click(function() {
    table.ajax.reload();
});