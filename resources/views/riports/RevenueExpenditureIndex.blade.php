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
                        <h4>Bevétel - Kiadás heti bontás</h4>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 box-body">
                                <table class="table table-hover table-bordered partners-table w-100">
                                    @include('riports.table')
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

            var table = $('.partners-table').DataTable({
                serverSide: true,
                scrollX: true,
                order: [[0, 'desc']],
                ajax: "{{ route('RevenueExpenditureIndex') }}",
                scrollY: AppConfig.scrollY + 'px',
                pageLength: AppConfig.pageLength,
                select: false,
                paging: false,
                columns: [
                    {title: 'Hét', data: 'yearweek', sClass: "text-center", width: '150px', name: 'yearweek'},
                    {
                        title: 'Bevétel',
                        data: 'revenue',
                        render: $.fn.dataTable.render.number('.', ',', 0),
                        sClass: "text-right",
                        width: '150px',
                        name: 'revenue'
                    },
                    {
                        title: 'Kiadás',
                        data: 'spend',
                        render: $.fn.dataTable.render.number('.', ',', 0),
                        sClass: "text-right",
                        width: '150px',
                        name: 'spend'
                    },
                    {
                        title: 'Egyenleg',
                        data: 'result',
                        render: $.fn.dataTable.render.number('.', ',', 0),
                        sClass: "text-right",
                        width: '150px',
                        name: 'result'
                    },
                    {
                        title: '%',
                        data: 'resultPercent',
                        render: $.fn.dataTable.render.number('.', ',', 2),
                        sClass: "text-right",
                        width: '150px',
                        name: 'resultPercent'
                    },

                ],
                footerCallback: function (row, data, start, end, display) {
                    var api = this.api();

                    // Számérték kinyerése stringből, vagy megtartás, ha szám
                    var intVal = function (i) {
                        return typeof i === 'string'
                            ? i.replace(/[\.,]/g, '') * 1
                            : typeof i === 'number'
                                ? i
                                : 0;
                    };

                    // Oszlopindexek, amiket összeadunk
                    var columnsToSum = [1, 2, 3]; // cash, card, szcard

                    columnsToSum.forEach(function(colIdx) {
                        // Összeg az összes oldalon
                        var total = api
                            .column(colIdx)
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Összeg az aktuális oldalon (ha kell)
                        var pageTotal = api
                            .column(colIdx, {page: 'current'})
                            .data()
                            .reduce(function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Footer cella frissítése az adott oszlopban
                        $(api.column(colIdx).footer()).html(currencyFormatDE(total));
                    });
                },

            });

            var getYearStacked = <?php echo $data; ?>;
            var last27 = getYearStacked.slice(-27);

            console.log(last27);


            var chart_getYearStacked = null;
            var chart_getYearStackedPercent = null;

            function drawCharts() {
                var containerHeight = $('#getYearStacked').parent().height() || 650;
                var chartHeight = containerHeight / 2;

                chart_getYearStacked = highchartLine(
                    'getYearStacked',
                    'line',
                    chartHeight,
                    setCategories(last27),
                    chartDataUpload(last27, ['card', 'szcard', 'cash'], ['Kártya', 'SZÉP kártya', 'Készpénz']),
                    'Fizetési mód',
                    'heti bontás',
                    'forint'
                );

                chart_getYearStackedPercent = highchartLine(
                    'getYearStackedPercent',
                    'line',
                    chartHeight,
                    setCategories(last27),
                    chartDataUpload(last27, ['resultPercent'], ['Eredmény ráta']),
                    'Eredmény ráta',
                    'heti bontás',
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
                    category.push(data[i]['year']);
                }
                return category;
            }
        });
    </script>
@endsection


