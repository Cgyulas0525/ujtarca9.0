<script type="text/javascript">
    function orderDetailsTableAjax() {
        var table = $('.detailstable').DataTable({
            serverSide: true,
            scrollY: 300,
            scrollX: true,
            order: [[1, 'asc']],
            paging: false,
            searching: false,
            select: false,
            ajax: "{{ route('orderDetailsIndex', ['id' => $orders->id]) }}",
            columns: [
                {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('orderdetailsCreate', ['id' => $orders->id]) !!}"><i class="fa fa-plus-square"></i></a>',
                    data: 'action', sClass: "text-center", width: '50px', name: 'action', orderable: false, searchable: false},
                {title: 'Termék', data: 'productName', name: 'productName', id: 'productName'},
                {title: 'Me.', data: 'quantityName', name: 'quantityName', id: 'quantityName'},
                {title: 'Mennyiség', data: 'value', name: 'value', id: 'value'},
                {title: 'Érték', data: 'detailvalue', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'100px', name: 'detailvalue', id: 'detailvalue'},
                {title: 'Id', data: 'id', name: 'id', id: 'id'},
            ],
            columnDefs: [
                {
                    targets: [5],
                    visible: false
                },
                {
                    targets: [3],
                    sClass: 'text-right',
                    width:'150px',
                    render: function ( data, type, full, meta ) {
                        return '<input class="form-control text-right" type="number" value="'+ data +'" onfocusout="QuantityChange('+meta["row"]+', this.value)" pattern="[0-9]+([\.,][0-9]+)?" step="1" style="width:250px;height:20px;font-size: 15px;"/>';
                    },
                }
            ],
            buttons: [],
            footerCallback: function (row, data, start, end, display) {
                var api = this.api();

                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };

                // Total over all pages
                total = api
                    .column(4)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal = api
                    .column(4, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(4).footer()).html(currencyFormatDE(total));
            },
        });
        return table;
    }
</script>
