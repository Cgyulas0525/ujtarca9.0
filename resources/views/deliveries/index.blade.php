@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="css/app.css">
    @include('layouts.costumcss')
@endsection

@section('content')
    @include('layouts.index', ['title' => 'Kiszállítások'])
@endsection

@section('scripts')

    <script src="{{ asset('/js/ajaxsetup.js') }} " type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            var table = $('.partners-table').DataTable({
                serverSide: true,
                scrollY: 500,
                scrollX: true,
                order: [[1, 'asc']],
                paging: false,
                ajax: "{{ route('deliveries.index') }}",
                columns: [
                    {
                        title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('deliveries.create') !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action',
                        sClass: "text-center",
                        width: '200px',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    {title: 'Sorszám', data: 'delivery_number', name: 'delivery_number'},
                    {title: 'Dátum', data: 'date', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'date'},
                    {title: 'Partner', data: 'location', name: 'location'},
                ],
                buttons: [],
            });

        });
    </script>
@endsection
