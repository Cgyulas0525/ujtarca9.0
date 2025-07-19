@extends('app-scaffold.html.app')

@section('css')
    <link rel="stylesheet" href="css/app.css">
    @include('app-scaffold.css.costumcss')
@endsection

@section('content')
    @include('layouts.index', ['title' => 'Kiszállítási címek'])
@endsection

@section('scripts')

    @include('functions.ajax_js')

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            var table = $('.partners-table').DataTable({
                serverSide: true,
                scrollX: true,
                order: [[2, 'asc']],
                scrollY: AppConfig.scrollY + 'px',
                pageLength: AppConfig.pageLength,
                ajax: "{{ route('locations.index') }}",
                columns: [
                    {
                        title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('locations.create') !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action',
                        sClass: "text-center",
                        width: '200px',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    {title: 'Név', data: 'name', name: 'name'},
                    {title: 'Ir.szám', data: 'pc', sClass: "text-right", width: '50px', name: 'pc'},
                    {title: 'Település', data: 'settlement', name: 'settlement'},
                    {title: 'Cím', data: 'address', name: 'address'},
                    {title: 'Partner', data: 'partnersCount', name: 'partnersCount'},
                ],
                buttons: [],
            });

        });
    </script>
@endsection


