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
                    <section class="content-header">
                        <h4>{{ $orders->ordernumber }} {{ date('Y.m.d', strtotime($orders->orderdate)) }}
                            Összesen: {{ number_format(OrderClass::sumOrderSupplierPrice($orders->id),0,",",".") }} Ft.
                            <a href="{{ route('orderPrint', ['id' => $orders->id]) }}" class="btn btn-success alapgomb printBtn" title="Nyomtatás"><i class="fas fa-print"></i></a>
                            <a href="{{ route('orderEmail', ['id' => $orders->id]) }}" class="btn btn-success alapgomb printBtn" title="Email"><i class="fas fa-envelope-open"></i></a>
                        </h4>
                    </section>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($orders, ['route' => ['orders.update', $orders->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('orders.editFields')
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
                <a href="{{ route('orders.index') }}" class="btn btn-default">Kilép</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/public/js/ajaxsetup.js') }} " type="text/javascript"></script>

    <script type="text/javascript">

        var table;

        $(function () {

            ajaxSetup();

            table = $('.detailstable').DataTable({
                serverSide: true,
                scrollY: 300,
                scrollX: true,
                order: [[1, 'asc']],
                paging: false,
                searching: false,
                select: false,
                ajax: "{{ route('orderdetailsIndex', ['id' => $orders->id]) }}",
                columns: [
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('orderdetailsCreate', ['id' => $orders->id]) !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width: '50px', name: 'action', orderable: false, searchable: false},
                    {title: 'Termék', data: 'productName', name: 'productName', id: 'productName'},
                    {title: 'Me.', data: 'quantityName', name: 'quantityName', id: 'quantityName'},
                    {title: 'Mennyiség', data: 'value', name: 'value', id: 'value'},
                    {title: 'Id', data: 'id', name: 'id', id: 'id'},
                ],
                columnDefs: [
                    {
                        targets: [4],
                        visible: false
                    },
                    {
                        targets: [3],
                        sClass: 'text-right',
                        width:'150px',
                        render: function ( data, type, full, meta ) {
                            return '<input class="form-control text-right" type="number" value="'+ data +'" onfocusout="QuantityChange('+meta["row"]+', this.value)" pattern="[0-9]+([\.,][0-9]+)?" step="1" style="width:250px;height:20px;font-size: 15px;"/>';
                        },
                    }
                ],
                buttons: [],
            });
        });

        function QuantityChange(Row, value) {
            var d = table.row(Row).data();
            if ( d.value != value ) {
                d.value = value;
                $.ajax({
                    type:"GET",
                    url:"{{url('orderdetailsUpdate')}}",
                    data: { id: d.id, value: value },
                    success: function (response) {
                        // console.log('Response:', response);
                    },
                    error: function (response) {
                        // console.log('Error:', response);
                        alert('nem ok');
                    }
                });
                table.row(Row).invalidate();
            }
        }
    </script>
@endsection

