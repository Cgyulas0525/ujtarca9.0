@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="css/app.css">
    @include('layouts.costumcss')
@endsection

@section('content')
    @include('layouts.index', ['title' => 'Kiszállítási címek'])
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
                order: [[2, 'asc']],
                paging: false,
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


