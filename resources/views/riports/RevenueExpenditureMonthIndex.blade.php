@extends('layouts.appblack')

@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('app-scaffold.css.costumcss')

    <style>
        .dataTables_info,
        .dataTables_filter label {
            color: #fff !important;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <section class="content-header">
                        <h4>Bevétel - Kiadás havi bontás</h4>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 box-body">
                                <table class="table table-hover table-bordered partners-table w-100">
                                    @include('riports.table')
                                </table>
                                <table class="table table-hover table-bordered stacked-report-table w-100">
                                    @include('stacked_report.table')
                                </table>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 box-body">
                                <figure class="highcharts-figure w-100">
                                    <div id="getYearStacked"></div>
                                </figure>
                                <figure class="highcharts-figure w-100">
                                    <div id="getYearStackedPercent"></div>
                                </figure>
                            </div>
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
    @include('functions.highchart.highchartLine_js')
    @include('functions.highchart.categoryUpload_js')
    @include('functions.highchart.chartDataUpload_js')
    @include('functions.highchart.highchartsTheme_js')

    <script type="text/javascript">
        $(function () {
            ajaxSetup();
            hightchartsTheme();

            var intVal = function(i) {
                if (typeof i === 'string') return parseFloat(i.replace(/[\.,]/g, '')) || 0;
                return typeof i === 'number' ? i : 0;
            };

            // Első DataTable
            var tablePartners = $('.partners-table').DataTable({
                serverSide: true,
                ajax: "{{ route('RevenueExpenditureMonthIndex') }}",
                scrollX: true,
                scrollY: ((AppConfig.scrollY / 2) - 100) + 'px',
                pageLength: AppConfig.pageLength,
                order: [[0, 'desc']],
                paging: false,
                columns: [
                    {title: 'Hónap', data: 'yearmonth', sClass: "text-center"},
                    {title: 'Bevétel', data: 'revenue', render: $.fn.dataTable.render.number('.', ',', 0), sClass: "text-right"},
                    {title: 'Kiadás', data: 'spend', render: $.fn.dataTable.render.number('.', ',', 0), sClass: "text-right"},
                    {title: 'Egyenleg', data: 'result', render: $.fn.dataTable.render.number('.', ',', 0), sClass: "text-right"},
                    {title: '%', data: 'resultPercent', render: $.fn.dataTable.render.number('.', ',', 2), sClass: "text-right"}
                ],
                footerCallback: function(row, data, start, end, display) {
                    var api = this.api();
                    var cols = [1, 2, 3]; // csak számolt oszlopok
                    // Nullázás
                    cols.forEach(col => $(api.column(col).footer()).html('0'));
                    // Összegzés
                    cols.forEach(col => {
                        var total = api.column(col, {page:'all'}).data().reduce((a, b) => intVal(a)+intVal(b), 0);
                        $(api.column(col).footer()).html(currencyFormatDE(total));
                    });
                }
            });

            // Második DataTable
            var tableStacked = $('.stacked-report-table').DataTable({
                serverSide: true,
                ajax: "{{ route('getMonthStackedIndex') }}",
                scrollX: true,
                scrollY: ((AppConfig.scrollY / 2) - 100) + 'px',
                pageLength: AppConfig.pageLength,
                order: [[0, 'desc']],
                paging: false,
                columns: [
                    {title: 'Hónap', data: 'yearmonth', sClass: "text-center"},
                    {title: 'Készpénz', data: 'cash', render: $.fn.dataTable.render.number('.', ',', 0), sClass: "text-right"},
                    {title: 'Kártya', data: 'card', render: $.fn.dataTable.render.number('.', ',', 0), sClass: "text-right"},
                    {title: 'Szép kártya', data: 'szcard', render: $.fn.dataTable.render.number('.', ',', 0), sClass: "text-right"}
                ],
                footerCallback: function(row, data, start, end, display) {
                    var api = this.api();
                    var cols = [1, 2, 3];
                    // Nullázás
                    cols.forEach(col => $(api.column(col).footer()).html('0'));
                    // Összegzés
                    cols.forEach(col => {
                        var total = api.column(col, {page:'all'}).data().reduce((a, b) => intVal(a)+intVal(b), 0);
                        $(api.column(col).footer()).html(currencyFormatDE(total));
                    });
                }
            });

            var getYearStacked = <?php echo $data; ?>;
            var last13 = getYearStacked.slice(-13);

            console.log(last13);


            var chart_getYearStacked = null;
            var chart_getYearStackedPercent = null;

            function drawCharts() {
                var containerHeight = $('#getYearStacked').parent().height() || 650;
                var chartHeight = containerHeight / 2;

                chart_getYearStacked = highchartLine(
                    'getYearStacked',
                    'line',
                    chartHeight,
                    setCategories(last13),
                    chartDataUpload(last13, ['card', 'szcard', 'cash'], ['Kártya', 'SZÉP kártya', 'Készpénz']),
                    'Fizetési mód',
                    'havi bontás',
                    'forint'
                );

                chart_getYearStackedPercent = highchartLine(
                    'getYearStackedPercent',
                    'line',
                    chartHeight,
                    setCategories(last13),
                    chartDataUpload(last13, ['resultPercent'], ['Eredmény ráta']),
                    'Eredmény ráta',
                    'havi bontás',
                    'százalék'
                );
            }

            drawCharts();

            $(window).on('resize', function () {
                var containerHeight = $('#getYearStacked').parent().height() || 650;
                var chartHeight = containerHeight / 2;

                if (chart_getYearStacked) chart_getYearStacked.setSize(null, chartHeight);
                if (chart_getYearStackedPercent) chart_getYearStackedPercent.setSize(null, chartHeight);
            });

            function setCategories(data) {
                var category = [];
                for (var i = 0; i < data.length; i++) {
                    category.push(data[i]['yearmonth']);
                }
                return category;
            }
        });
    </script>
@endsection


