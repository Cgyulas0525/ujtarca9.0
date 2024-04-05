<script type="text/javascript">
    function setTable() {
        var table = $('.partners-table').DataTable({
            processing: true,
            serverSide: true,
            scrollY: 500,
            scrollX: true,
            paging: false,
            order: [[3, 'desc'], [1, 'asc'], [2, 'asc']],
            ajax: "{{ route('invoicesIndex', ['year' => Illuminate\Support\Facades\Session::get('invoiceYear'),
                                              'partner' => Illuminate\Support\Facades\Session::get('invoicePartner')]) }}",
            columns: [
                {
                    title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('invoices.create') !!}"><i class="fa fa-plus-square"></i></a>',
                    data: 'action',
                    sClass: "text-center",
                    width: '100px',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {title: 'Partner', data: 'partnerName', width: '350px', name: 'partnerName'},
                {title: 'Számlaszám', data: 'invoicenumber', name: 'invoicenumber'},
                {
                    title: 'Kelt', data: 'dated', render: function (data, type, row) {
                        return data ? moment(data).format('YYYY.MM.DD') : '';
                    }, sClass: "text-center", width: '150px', name: 'dated'
                },
                {
                    title: 'Teljesítés', data: 'performancedate', render: function (data, type, row) {
                        return data ? moment(data).format('YYYY.MM.DD') : '';
                    }, sClass: "text-center", width: '150px', name: 'performancedate'
                },
                {
                    title: 'Fiz.hat', data: 'deadline', render: function (data, type, row) {
                        return data ? moment(data).format('YYYY.MM.DD') : '';
                    }, sClass: "text-center", width: '150px', name: 'deadline'
                },
                {title: 'Fizetési mód', data: 'paymentMethodName', name: 'paymentMethodName'},
                {
                    title: 'Összeg',
                    data: 'amount',
                    render: $.fn.dataTable.render.number('.', ',', 0),
                    sClass: "text-right",
                    width: '100px',
                    name: 'amount'
                },
                {
                    title: 'Utalás', data: 'referred_date', render: function (data, type, row) {
                        return data ? moment(data).format('YYYY.MM.DD') : '';
                    }, sClass: "text-center", width: '150px', name: 'referred_date'
                },
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
                    .column(7)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal = api
                    .column(7, {page: 'current'})
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(7).footer()).html(currencyFormatDE(total));
            },
            fnRowCallback: function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                if (aData.paymentmethod_id == 2 && aData.referred_date == null) {
                    $('td', nRow).css('background-color', 'red');
                }
            },
        });
        return table;
    }
</script>

