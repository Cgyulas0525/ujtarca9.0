<script type="text/javascript">
    function indexTable() {
        var table = $('.partners-table').DataTable({
            serverSide: true,
            scrollY: 390,
            scrollX: true,
            order: [[1, 'asc']],
            ajax: "{{ route('paymentMethods.index') }}",
            columns: [
                {
                    title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('paymentMethods.create') !!}"><i class="fa fa-plus-square"></i></a>',
                    data: 'action',
                    sClass: "text-center",
                    width: '200px',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {title: 'Név', data: 'name', name: 'name'},
            ]
        });
    }
</script>
