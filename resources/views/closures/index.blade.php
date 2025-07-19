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
                        <h4>Zárás</h4>
                        <div class="form-group col-sm-6">
                            <div class="row">
                                <div class="mylabel col-sm-1">
                                    {!! Form::label('year', 'Év:') !!}
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::select('year', $years, date('Y'), ['class'=>'select2 form-control', 'id' => 'year']) !!}
                                </div>
                            </div>
                        </div>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body">
                            <table class="table table-hover table-bordered partners-table w-100">
                                @include('closures.table')
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
    @include('functions.ajax_js')
    @include('functions.currencyFormatDE')
    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            var table = $('.partners-table').DataTable({
                serverSide: true,
                scrollX: true,
                order: [[1, 'desc']],
                ajax: "{{ route('closuresIndex', ['ev' => date('Y')]) }}",
                scrollY: AppConfig.scrollY + 'px',
                pageLength: AppConfig.pageLength,
                select: false,

                columns: [
                    {
                        title: '<a class="btn btn-primary" title="Felvitel" href="{!! route('closures.create') !!}"><i class="fa fa-plus-square"></i></a>',
                        data: 'action',
                        sClass: "text-center",
                        width: '200px',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    {
                        title: 'Kelt', data: 'closuredate', render: function (data, type, row) {
                            return data ? moment(data).format('YYYY.MM.DD') : '';
                        }, sClass: "text-center", width: '150px', name: 'closuredate'
                    },
                    {
                        title: 'Kártya',
                        data: 'card',
                        render: $.fn.dataTable.render.number('.', ',', 0),
                        sClass: "text-right",
                        width: '150px',
                        name: 'card'
                    },
                    {
                        title: 'Szép kártya',
                        data: 'szcard',
                        render: $.fn.dataTable.render.number('.', ',', 0),
                        sClass: "text-right",
                        width: '150px',
                        name: 'szcard'
                    },
                    {
                        title: 'Napközben',
                        data: 'dayduring',
                        render: $.fn.dataTable.render.number('.', ',', 0),
                        sClass: "text-right",
                        width: '150px',
                        name: 'dayduring'
                    },
                    {
                        title: 'Összesen',
                        data: 'closureValue',
                        render: $.fn.dataTable.render.number('.', ',', 0),
                        sClass: "text-right",
                        width: '150px',
                        name: 'closureValue',
                    },
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
                        .column(5)
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Total over this page
                    pageTotal = api
                        .column(5, {page: 'current'})
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    // Update footer
                    $(api.column(5).footer()).html(currencyFormatDE(total));
                },

            });

            $('#year').change(function () {
                let url = '{{ route('closuresIndex', [":ev"]) }}';
                url = url.replace(':ev', $('#year').val());
                table.ajax.url(url).load();
            })
        });
    </script>
@endsection


