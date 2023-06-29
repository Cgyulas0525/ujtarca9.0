<script type="text/javascript">
    function tableData(witch, order, ajaxRoute, columns, sumColumn) {
        tdata =  $(witch).DataTable({
                        serverSide: true,
                        scrollY: 390,
                        scrollX: true,
                        order: order,
                        paging: false,
                        searching: false,
                        select: false,
                        ajax: ajaxRoute,
                        columns: columns,
                        buttons: [],
                        footerCallback: function (row, data, start, end, display) {
            var api = this.api();

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                            };

            // Total over all pages
            total = api
                .column(sumColumn)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Total over this page
            pageTotal = api
                .column(sumColumn, { page: 'current' })
                                .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

                            // Update footer
                            $(api.column(sumColumn).footer()).html(currencyFormatDE(total));
                        },

                    });

        return tdata;
    }
</script>

