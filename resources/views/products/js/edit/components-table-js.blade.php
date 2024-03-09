<script type="text/javascript">
    function componentsTable() {
        table = $('.partners-table').DataTable({
            serverSide: true,
            scrollY: 300,
            scrollX: true,
            paging: false,
            order: [[0, 'asc']],
            ajax: "{{ route('componentProductIndex', ['product' => $products]) }}",
            columns: [
                {title: 'Név', data: 'name', name: 'name'},
                {title: 'Mennyiség', data: 'value', name: 'value', id: 'value'},
                {title: 'componentId', data: 'componentId', name: 'componentId', id: 'componentId'},
                {title: 'productId', data: 'productId', name: 'productId', id: 'productId'},
            ],
            columnDefs: [
                {
                    targets: [1],
                    sClass: 'text-right',
                    width: '150px',
                    render: function (data, type, full, meta) {
                        return '<input class="form-control text-right" type="number" value="' + data + '" onfocusout="componentProductUpdate(' + meta["row"] + ', this.value, table)" pattern="[0-9]+([\.,][0-9]+)?" step="0.01" style="width:250px;height:20px;font-size: 15px;"/>';
                    },
                },
                {
                    targets: [2, 3],
                    visible: false
                },
            ],
            buttons: [],
        });
    }
</script>
