@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('layouts.costumcss')
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>{{ $offers->offernumber }} {{ date('Y.m.d', strtotime($offers->offerdate)) }}</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($offers, ['route' => ['offers.update', $offers->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('offers.editFields')
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-xs-12 mt-n4">

                <section class="content-header">
                    <h1 class="pull-left">Tételek</h1>
                </section>
                <div class="content">
                    <div class="clearfix"></div>

                    @include('flash::message')

                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered detailstable w-100"></table>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">

                    </div>
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('offers.index') }}" class="btn btn-default">Kilép</a>
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/public/js/ajaxsetup.js') }} " type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            var table = $('.detailstable').DataTable({
                serverSide: true,
                scrollY: 390,
                scrollX: true,
                order: [[1, 'asc']],
                paging: false,
                ajax: "{{ route('offerdetailsIndex', ['id' => $offers->id]) }}",
                columns: [
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('offerdetailsCreate', ['id' => $offers->id]) !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width: '200px', name: 'action', orderable: false, searchable: false},
                    {title: 'Termék', data: 'productName', name: 'productName'},
                    {title: 'Me.', data: 'quantityName', name: 'quantityName'},
                    {title: 'Mennyiség', data: 'value', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'100px', name: 'value'},
                ],
                buttons: [],
            });

        });
    </script>
@endsection

