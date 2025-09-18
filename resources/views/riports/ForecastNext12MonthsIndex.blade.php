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
                        <h4>Előrejelzés</h4>
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
                                <div class="form-group">
                                    <label for="chartSelect">Mutató:</label>
                                    <select id="chartSelect" class="form-control" style="width: 200px;">
                                        <option value="revenue">Bevétel</option>
                                        <option value="spend">Kiadás</option>
                                        <option value="result">Eredmény</option>
                                    </select>
                                </div>
                                <figure class="highcharts-figure w-100">
                                    <div id="getYearStacked"></div>
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
    @include('functions.highchart.highchartColumn_js')
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
                ajax: "{{ route('forecastNext12MonthsIndex') }}",
                scrollY: AppConfig.scrollY + 'px',
                pageLength: AppConfig.pageLength,
                select: false,
                paging: false,
                columns: [
                    {title: 'Hónap', data: 'year_month', sClass: "text-center", width: '150px', name: 'year_month'},
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

            var chartData = <?php echo json_encode($chartData); ?>;
            console.log(chartData);

            var chart = Highcharts.chart('getYearStacked', {
                chart: { type: 'column' },
                title: { text: 'Havi bevétel összehasonlítás' },
                xAxis: { categories: chartData['revenue'].categories },
                yAxis: { title: { text: 'Forint' } },
                tooltip: { shared: true, valueDecimals: 0, valuePrefix: '' },
                plotOptions: { column: { grouping: true, shadow: false, borderWidth: 0 } },
                series: deepCopy(chartData['revenue'].series)
            });

            $('#chartSelect').on('change', function() {
                var metric = $(this).val();

                if (metric === 'revenue') {
                    chart.setTitle({ text: 'Havi bevétel összehasonlítás' });
                } else if (metric === 'spend') {
                    chart.setTitle({ text: 'Havi kiadás összehasonlítás' });
                } else if (metric === 'result') {
                    chart.setTitle({ text: 'Havi eredmény összehasonlítás' });
                }

                console.log(metric, chartData[metric].series, chartData);

                chart.update({
                    xAxis: { categories: chartData[metric].categories },
                    series: deepCopy(chartData[metric].series)
                }, true, true, false);
            });

            function deepCopy(obj) {
                return JSON.parse(JSON.stringify(obj));
            }
        });
    </script>
@endsection


