@extends('app-scaffold.html.app')

@section('css')
    @include('app-scaffold.css.costumcss')
@endsection

@section('content')
    @include('layouts.index', ['title' => 'Kiszállítások'])
@endsection

@section('scripts')

    @include('functions.ajax_js')

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
                    {
                        title: 'Dátum', data: 'date', render: function (data, type, row) {
                            return data ? moment(data).format('YYYY.MM.DD') : '';
                        }, sClass: "text-center", width: '150px', name: 'date'
                    },
                    {title: 'Partner', data: 'location', name: 'location'},
                    {
                        title: 'Megrendelés db',
                        data: 'orderNumber',
                        width: '150px',
                        render: $.fn.dataTable.render.number('.', ',', 0),
                        name: 'orderNumber',
                        render: $.fn.dataTable.render.number('.', ',', 0),
                        sClass: "text-right",
                    },
                ],
                buttons: [],
            });

        });
    </script>
@endsection
