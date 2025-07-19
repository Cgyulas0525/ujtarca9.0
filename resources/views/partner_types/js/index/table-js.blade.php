<script type="text/javascript">
    function indexTable() {
        var table = $('.partners-table').DataTable({
            serverSide: true,
            scrollY: AppConfig.scrollY + 'px',
            pageLength: AppConfig.pageLength,
            scrollX: true,
            order: [[1, 'asc']],
            ajax: "{{ route('partnerTypes.index') }}",
            columns: [
                {
                    title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('partnerTypes.create') !!}"><i class="fa fa-plus-square"></i></a>',
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
