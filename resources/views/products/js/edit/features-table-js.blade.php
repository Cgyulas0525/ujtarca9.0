<script type="text/javascript">
    function featuresTable() {
        table = $('.f_table').DataTable({
            serverSide: true,
            scrollY: 220,
            scrollX: true,
            paging: false,
            searching: false,
            order: [[0, 'asc']],
            ajax: "{{ route('featureProductIndex', ['product' => $products]) }}",
            columns: [
                {title: 'Név', data: 'name', name: 'name'},
                {
                    title: 'Ikon', data: "media", sClass: "text-center", "render": function (data) {
                        return '<img src="' + data + '" style="height:20px;width:20px;object-fit:cover;"/>';
                    }
                },
                {title: 'Kiválasztva', data: 'value', name: 'value', id: 'value'},
                {title: 'featureId', data: 'featureId', name: 'featureId', id: 'featureId'},
                {title: 'productId', data: 'productId', name: 'productId', id: 'productId'},
            ],
            columnDefs: [
                {
                    targets: [2],
                    sClass: 'text-right',
                    width: '150px',
                    render: function (data, type, full, meta) {
                        var isChecked = data === 1 ? 'checked' : '';
                        return '<input class="form-control text-right" type="checkbox" value="' + data + '" onchange="featureProductUpdate(' + meta["row"] + ', this.value, table)" style="height:20px;font-size: 15px;" ' + isChecked + ' />';
                    },
                },
                {
                    targets: [3, 4],
                    visible: false
                },
            ],
            buttons: [],
        });
    }
</script>
