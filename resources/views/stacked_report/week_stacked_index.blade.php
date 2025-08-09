@extends('layouts.appblack')

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
                            <h4>Heti fizetésimód</h4>
                        </div>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="box box-primary" style="margin-top: 10px;">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 box-body">
                                <table class="table table-hover table-bordered partners-table w-100">
                                    @include('stacked_report.table')
                                </table>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 box-body">
                                <figure class="highcharts-figure w-100">
                                    <div id="getWeekStacked"></div>
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
    @include('functions.currencyFormatDE')
    @include('functions.ajax_js')
    @include('functions.highchart.highchartLine_js')
    @include('functions.highchart.categoryUpload_js')
    @include('functions.highchart.chartDataUpload_js')
    @include('functions.highchart.highchartsTheme_js')

    <script type="text/javascript">
        $(function () {

            ajaxSetup();
            hightchartsTheme();

            var table = $('.partners-table').DataTable({
                // processing: true,
                serverSide: true,
                scrollX: true,
                scrollY: AppConfig.scrollY + 'px',
                pageLength: AppConfig.pageLength,
                order: [[0, 'desc'], [1, 'desc']],
                paging: false,
                searching: false,
                ajax: "{{ route('getWeekStackedIndex') }}",
                columns: [
                    {title: 'Hét', data: 'yearweek', name: 'yearweek'},
                    {
                        title: 'Készpénz',
                        data: 'cash',
                        render: $.fn.dataTable.render.number('.', ',', 0),
                        sClass: "text-right",
                        width: '100px',
                        name: 'cash'
                    },
                    {
                        title: 'Kártya',
                        data: 'card',
                        render: $.fn.dataTable.render.number('.', ',', 0),
                        sClass: "text-right",
                        width: '100px',
                        name: 'card'
                    },
                    {
                        title: 'Szép kártya',
                        data: 'szcard',
                        render: $.fn.dataTable.render.number('.', ',', 0),
                        sClass: "text-right",
                        width: '100px',
                        name: 'szcard'
                    },
                ],
                buttons: [],
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

            var getWeekStacked = <?php echo $data; ?>;

            var chart_getWeekStacked = highchartLine('getWeekStacked', 'line', 450, setCategories(getWeekStacked),
                chartDataUpload(getWeekStacked, ['card', 'szcard', 'cash'], ['Kártya', 'SZÉP kártya', 'Készpénz']), 'Fizetési mód', 'hati bontás', 'forint');

        });

        function setCategories(data) {
            category = [];
            for (i = 0; i < data.length; i++){
                category.push(
                    data[i]['year'] + '.' + String(data[i]['week']).padStart(2, '0')
                );
            }
            return category;
        }



    </script>
@endsection

