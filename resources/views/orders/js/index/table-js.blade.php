<script type="text/javascript">
    function indexTable() {
        return $('.partners-table').DataTable({
            serverSide: true,
            scrollY: AppConfig.scrollY + 'px',
            pageLength: AppConfig.pageLength,
            scrollX: true,
            order: [[1, 'desc'], [2, 'asc']],
            ajax: "{{ route('ordersIndex', [empty($_COOKIE['orderType']) ? 'vevői' : (($_COOKIE['orderType'] == 'CUSTOMER') ? 'vevői' : 'szállítói'),
                                                empty($_COOKIE['orderStatus']) ? 'megrendelt' : (($_COOKIE['orderStatus'] == 'ORDERED') ? 'megrendelt' : (($_COOKIE['orderStatus'] == 'PACKAGED') ? 'csomagolt' : 'kiszállított'))]) }}",
            columns: [
                {
                    title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('orders.create') !!}"><i class="fa fa-plus-square"></i></a>',
                    data: 'action',
                    sClass: "text-center",
                    width: '200px',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    title: 'Dátum', data: 'orderdate', render: function (data, type, row) {
                        return data ? moment(data).format('YYYY.MM.DD') : '';
                    }, sClass: "text-center", width: '150px', name: 'orderdate'
                },
                {title: 'Megrendelés', data: 'ordernumber', name: 'ordernumber'},
                {title: 'Kiszállítás', data: 'deliveryNumber', name: 'deliveryNumber'},
                {title: 'Partner', data: 'partnerName', name: 'partnerName'},
                {
                    title: 'Státusz',
                    data: 'order_status',
                    sClass: "text-center",
                    width: '100px',
                    name: 'order_status'
                },
                {
                    title: 'Összesen',
                    data: 'detailsum',
                    render: $.fn.dataTable.render.number('.', ',', 0),
                    sClass: "text-right",
                    width: '100px',
                    name: 'detailsum'
                },
            ],
            columnDefs: [
                {
                    targets: [3],
                    visible: $('#orderType').val() == 'CUSTOMER',
                },
            ],
            buttons: [],
        });
    }
</script>
