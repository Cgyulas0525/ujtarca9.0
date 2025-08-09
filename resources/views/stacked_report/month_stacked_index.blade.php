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
                            <h4>Month Stacked</h4>
                        </div>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="box box-primary" style="margin-top: 10px;">
                        <div class="box-body">
                            <table class="table table-hover table-bordered partners-table w-100"></table>
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
                order: [[0, 'desc'], [1, 'desc']],
                ajax: "{{ route('getMonthStackedIndex') }}",
                columns: [
                    {title: 'year', data: 'year', name: 'year'},
                    {title: 'month', data: 'month', name: 'month'},
                    {
                        title: 'Revenue',
                        data: 'revenue',
                        render: $.fn.dataTable.render.number('.', ',', 0),
                        sClass: "text-right",
                        width: '100px',
                        name: 'revenue'
                    },
                ],
                // columnDefs: [
                //     {
                //         targets: [0],
                //         orderable: false,
                //         visible: false,
                //     }
                // ],
                buttons: [],
                // footerCallback: function (row, data, start, end, display) {
                //     var api = this.api();
                //
                //     // Remove the formatting to get integer data for summation
                //     var intVal = function (i) {
                //         return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                //     };
                //
                //     // Total over all pages
                //     total = api
                //         .column(7)
                //         .data()
                //         .reduce(function (a, b) {
                //             return intVal(a) + intVal(b);
                //         }, 0);
                //
                //     // Total over this page
                //     pageTotal = api
                //         .column(7, {page: 'current'})
                //         .data()
                //         .reduce(function (a, b) {
                //             return intVal(a) + intVal(b);
                //         }, 0);
                //
                //     // Update footer
                //     $(api.column(7).footer()).html(currencyFormatDE(total));
                // },

            });

            {{--$('.filterBtn').click(function () {--}}
            {{--    let begin = $('#begin').val();--}}
            {{--    let end = $('#end').val();--}}
            {{--    console.log(begin, end);--}}
            {{--    let partner = $('#partner').val() != 0 ? $('#partner').val() : -9999;--}}
            {{--    let url = '{{ route('partnerTrafficIndex', [":begin", ":end", ":partner"]) }}';--}}
            {{--    url = url.replace(':begin', begin);--}}
            {{--    url = url.replace(':end', end);--}}
            {{--    url = url.replace(':partner', partner);--}}
            {{--    table.ajax.url(url).load();--}}
            {{--});--}}

        });


    </script>
@endsection

