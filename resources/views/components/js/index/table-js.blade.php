<script type="text/javascript">
    function indexTable() {
        var table = $('.partners-table').DataTable({
            serverSide: true,
            scrollX: true,
            scrollY: AppConfig.scrollY + 'px',
            pageLength: AppConfig.pageLength,
            order: [[0, 'asc']],
            ajax: "{{ route('components.index') }}",
            columns: [
                {
                    title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('components.create') !!}"><i class="fa fa-plus-square"></i></a>',
                    data: 'action',
                    sClass: "text-center",
                    width: '200px',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {title: 'Név', data: 'name', name: 'name'},
                {title: 'Megjegyzés', data: 'description', name: 'description'},
            ],
            buttons: [],
        });
    }
</script>
