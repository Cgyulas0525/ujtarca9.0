@extends('app-scaffold.html.app')

@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('app-scaffold.css.costumcss')
@endsection

@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <section class="content-header">
                        <div class="form-group col-sm-12">
                            <h4>Számla</h4>
                            <div class="form-group col-sm-12">
                                <div class="row">
                                    <div class="mylabel col-sm-1">
                                        {!! Form::label('year', 'Tól:') !!}
                                    </div>
                                    <div class="col-sm-2">
                                        {!! Form::date('begin', date('Y-m-d', strtotime('first day of January')),
                                                  ['class' => 'form-control','id'=>'begin', 'required' => true]) !!}
                                    </div>
                                    <div class="mylabel col-sm-1">
                                        {!! Form::label('year', 'Ig:') !!}
                                    </div>
                                    <div class="col-sm-2">
                                        {!! Form::date('end', \Carbon\Carbon::now(),
                                                  ['class' => 'form-control','id'=>'end', 'required' => true]) !!}
                                    </div>
                                    <div class="mylabel col-sm-1">
                                        {!! Form::label('partner', 'Partner:') !!}
                                    </div>
                                    <div class="col-sm-4">
                                        {!! Form::select('partner', SelectService::selectSupplier(), null,
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
                    <div class="box box-primary" style="margin-top: 10px;">
                        <div class="box-body">
                            <table class="table table-hover table-bordered partners-table" style="width: 100%;">
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
    @include('functions.currencyFormatDE')
    @include('functions.ajax_js')

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            var table = $('.partners-table').DataTable({
                processing: true,
                serverSide: true,
                scrollX: true,
                scrollY: AppConfig.scrollY + 'px',
                pageLength: AppConfig.pageLength,
                order: [[3, 'desc'], [1, 'asc'], [2, 'asc']],
                ajax: "{{ route('pTIndex') }}",
                columns: [
                    {
                        title: 'Id',
                        data: 'id',
                        sClass: "text-center",
                        width: '1px',
                        name: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {title: 'Partner', data: 'partnerName', width: '350px', name: 'partnerName'},
                    {title: 'Számlaszám', data: 'invoicenumber', name: 'invoicenumber'},
                    {
                        title: 'Kelt', data: 'dated', render: function (data, type, row) {
                            return data ? moment(data).format('YYYY.MM.DD') : '';
                        }, sClass: "text-center", width: '150px', name: 'dated'
                    },
                    {
                        title: 'Teljesítés', data: 'performancedate', render: function (data, type, row) {
                            return data ? moment(data).format('YYYY.MM.DD') : '';
                        }, sClass: "text-center", width: '150px', name: 'performancedate'
                    },
                    {
                        title: 'Fiz.hat', data: 'deadline', render: function (data, type, row) {
                            return data ? moment(data).format('YYYY.MM.DD') : '';
                        }, sClass: "text-center", width: '150px', name: 'deadline'
                    },
                    {title: 'Fizetési mód', data: 'paymentMethodName', name: 'paymentMethodName'},
                    {
                        title: 'Összeg',
                        data: 'amount',
                        render: $.fn.dataTable.render.number('.', ',', 0),
                        sClass: "text-right",
                        width: '100px',
                        name: 'amount'
                    },
                ],
                columnDefs: [
                    {
                        targets: [0],
                        orderable: false,
                        visible: false,
                    }
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
                        .column(7, {page: 'current'})
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    $(api.column(7).footer()).html(currencyFormatDE(total));
                },

            });

            $('.filterBtn').click(function () {
                let begin = $('#begin').val();
                let end = $('#end').val();
                console.log(begin, end);
                let partner = $('#partner').val() != 0 ? $('#partner').val() : -9999;
                let url = '{{ route('partnerTrafficIndex', [":begin", ":end", ":partner"]) }}';
                url = url.replace(':begin', begin);
                url = url.replace(':end', end);
                url = url.replace(':partner', partner);
                table.ajax.url(url).load();
            });

        });


    </script>
@endsection


