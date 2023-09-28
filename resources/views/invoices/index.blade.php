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
                            <h4>Számla</h4>
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <div class="mylabel col-sm-1">
                                        {!! Form::label('year', 'Év:') !!}
                                    </div>
                                    <div class="col-sm-2">
                                        {!! Form::select('year', SelectService::invoicesYearsSelect(),date('Y'),
                                                ['class'=>'select2 form-control', 'id' => 'year']) !!}
                                    </div>
                                    <div class="mylabel col-sm-2">
                                        {!! Form::label('partner', 'Partner:') !!}
                                    </div>
                                    <div class="col-sm-6">
                                        {!! Form::select('partner', SelectService::selectSuplier(), null,
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
                            <table class="table table-hover table-bordered partners-table w-100">
                                @include('invoices.table')
                            </table>
                        </div>
                    </div>
                    <div class="text-center"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/public/js/currencyFormatDE.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/public/js/ajaxsetup.js') }} " type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            var table = $('.partners-table').DataTable({
                processing: true,
                serverSide: true,
                scrollY: 500,
                scrollX: true,
                paging: false,
                order: [[3, 'desc'], [1, 'asc'], [2, 'asc']],
                ajax: "{{ route('invoicesIndex', ['ev' => date('Y')]) }}",
                columns: [
                    {title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('invoices.create') !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action', sClass: "text-center", width: '100px', name: 'action', orderable: false, searchable: false},
                    {title: 'Partner', data: 'partnerName', width:'350px', name: 'partnerName'},
                    {title: 'Számlaszám', data: 'invoicenumber', name: 'invoicenumber'},
                    {title: 'Kelt', data: 'dated', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'dated'},
                    {title: 'Teljesítés', data: 'performancedate', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'performancedate'},
                    {title: 'Fiz.hat', data: 'deadline', render: function (data, type, row) { return data ? moment(data).format('YYYY.MM.DD') : ''; }, sClass: "text-center", width:'150px', name: 'deadline'},
                    {title: 'Fizetési mód', data: 'paymentMethodName', name: 'paymentMethodName'},
                    {title: 'Összeg', data: 'amount', render: $.fn.dataTable.render.number( '.', ',', 0), sClass: "text-right", width:'100px', name: 'amount'},
                ],
                buttons: [],
                footerCallback: function (row, data, start, end, display) {
                    var api = this.api();

                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                    };

                    // Total over all pages
                    total = api
                        .column(7)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Total over this page
                    pageTotal = api
                        .column(7, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    $(api.column(7).footer()).html(currencyFormatDE(total));
                },

            });

            $('.filterBtn').click(function () {
                let year = $('#year').val();
                let partner = $('#partner').val();
                let url = '{{ route('invoicesIndex', [":ev", ":partner"]) }}';
                url = url.replace(':ev', year);
                url = url.replace(':partner', partner);
                table.ajax.url(url).load();
            })
        });
    </script>
@endsection


