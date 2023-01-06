@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('layouts.datatables_css')
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
                            <h4>Számla</h4>
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <div class="mylabel col-sm-1">
                                        {!! Form::label('year', 'Év:') !!}
                                    </div>
                                    <div class="col-sm-2">
                                        {!! Form::select('year', \App\Http\Controllers\InvoicesController::invoicesYearsDDDW(), null,
                                                ['class'=>'select2 form-control', 'id' => 'year']) !!}
                                    </div>
                                    <div class="mylabel col-sm-1">
                                        {!! Form::label('partner', 'Partner:') !!}
                                    </div>
                                    <div class="col-sm-7">
                                        {!! Form::select('partner', \App\Http\Controllers\PartnersController::DDDW(), null,
                                                ['class'=>'select2 form-control', 'id' => 'partner']) !!}
                                    </div>
                                    <div class="col-sm-1">
                                        <a href="#" class="btn btn-success filterBtn">Szűrés</a>
                                    </div>
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
    @include('layouts.datatables_js')

    <script type="text/javascript">
        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('.partners-table').DataTable({
                processing: true,
                serverSide: true,
                scrollY: 390,
                scrollX: true,
                order: [[3, 'desc'], [1, 'asc'], [2, 'asc']],
                ajax: "{{ route('invoicesIndex', ['ev' => date('Y')]) }}",
                columns: [
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('invoices.create') !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width: '200px', name: 'action', orderable: false, searchable: false},
                    {title: 'Partner', data: 'partnerName', name: 'partnerName'},
                    {title: 'Számlaszám', data: 'invoicenumber', name: 'invoicenumber'},
                    {title: 'Kelt', data: 'dated', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'dated'},
                    {title: 'Teljesítés', data: 'performancedate', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'performancedate'},
                    {title: 'Fiz.hat', data: 'deadline', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'deadline'},
                    {title: 'Fizetési mód', data: 'paymentMethodName', name: 'paymentMethodName'},
                    {title: 'Összeg', data: 'amount', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'150px', name: 'amount'},
                ]
            });

            $('.filterBtn').click(function () {
                let year = $('#year').val() != 0 ? $('#year').val() : -9999;
                let partner = $('#partner').val() != 0 ? $('#partner').val() : -9999;
                let url = '{{ route('invoicesIndex', [":ev", ":partner"]) }}';
                url = url.replace(':ev', year);
                url = url.replace(':partner', partner);
                table.ajax.url(url).load();
            });

        });
    </script>
@endsection


