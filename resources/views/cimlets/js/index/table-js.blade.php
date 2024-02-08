<script type="text/javascript">
    function indexTable() {
        var table = $('.partners-table').DataTable({
            serverSide: true,
            scrollY: 500,
            scrollX: true,
            order: [[2, 'asc']],
            paging: false,
            ajax: "{{ route('cimlets.index') }}",
            columns: [
                {
                    title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('cimlets.create') !!}"><i class="fa fa-plus-square"></i></a>',
                    data: 'action',
                    sClass: "text-center",
                    width: '200px',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {title: 'Név', data: 'name', name: 'name'},
                {
                    title: 'Érték',
                    data: 'value',
                    render: $.fn.dataTable.render.number('.', ',', 0),
                    sClass: "text-right",
                    width: '50px',
                    name: 'value'
                },
            ]
        });
    }
</script>
