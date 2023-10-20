@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('layouts.costumcss')
@endsection

@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary" >
            <div class="box-body">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <section class="content-header">
                        <div class="form-group col-sm-12">
                            <div class="row">
                                <div class="col-sm-2">
                                    <h4>Megrendelések</h4>
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::select('orderType', OrderTypeEnum::Options(), (empty($_COOKIE['orderType']) ? 'ACTIVE' : $_COOKIE['orderType']),
                                            ['class'=>'select2 form-control', 'id' => 'orderType']) !!}
                                </div>
                                <div class="col-sm-1">
                                    {!! Form::select('orderType', OrderStatusEnum::Options(), (empty($_COOKIE['orderStatus']) ? 'ORDERED' : $_COOKIE['orderStatus']),
                                            ['class'=>'select2 form-control', 'id' => 'orderStatus']) !!}
                                </div>
                            </div>
                        </div>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body"  >
                            <table class="table table-hover table-bordered partners-table" style="width: 100%;"></table>
                        </div>
                    </div>
                    <div class="text-center"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/public/js/ajaxsetup.js') }} " type="text/javascript"></script>
    @include('functions.cookiesFunctions_js')

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            var table = $('.partners-table').DataTable({
                serverSide: true,
                scrollY: 550,
                scrollX: true,
                order: [[1, 'desc'], [2, 'asc']],
                ajax: "{{ route('ordersIndex', [empty($_COOKIE['orderType']) ? 'vevői' : (($_COOKIE['orderType'] == 'CUSTOMER') ? 'vevői' : 'szállítói'),
                                                empty($_COOKIE['orderStatus']) ? 'megrendelt' : (($_COOKIE['orderStatus'] == 'ORDERED') ? 'megrendelt' : (($_COOKIE['orderStatus'] == 'PACKAGED') ? 'csomagolt' : 'kiszállított'))]) }}",
                columns: [
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('orders.create') !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width: '200px', name: 'action', orderable: false, searchable: false},
                    {title: 'Dátum', data: 'orderdate', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'orderdate'},
                    {title: 'Megrendelés', data: 'ordernumber', name: 'ordernumber'},
                    {title: 'Partner', data: 'partnerName', name: 'partnerName'},
                    {title: 'Státusz', data: 'order_status', sClass: "text-center", width:'100px', name: 'order_status'},
                    {title: 'Összesen', data: 'detailsum', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'100px', name: 'detailsum'},
                ],
                buttons: [],
            });

            $('#orderType').change(function () {
                let url = '{{ route('ordersIndex', [":orderType"]) }}';
                createCookie('orderType', $('#orderType').val(), '30');
                url = url.replace(':orderType', ($('#orderType').val() == 'CUSTOMER') ? 'vevői' : 'szállítói');
                table.ajax.url(url).load();
            })

            $('#orderStatus').change(function () {
                let url = '{{ route('ordersIndex', [":orderType", ":orderStatus"]) }}';
                createCookie('orderStatus', $('#orderStatus').val(), '30');
                url = url.replace(':orderType', ($('#orderType').val() == 'CUSTOMER') ? 'vevői' : 'szállítói');
                url = url.replace(':orderStatus', ($('#orderStatus').val() == 'ORDERED') ? 'megrendelt' : ($('#orderStatus').val() == 'PACKAGED') ? 'csomagolt' : 'kiszállított');
                table.ajax.url(url).load();
            })
        });
    </script>
@endsection


