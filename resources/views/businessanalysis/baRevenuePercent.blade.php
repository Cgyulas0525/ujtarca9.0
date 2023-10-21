<div class="row">
    @include('businessanalysis.baRevenuePercentItem', ['title' => 'Árbevétel típus százalék', 'chartId' => 'year', 'witch' => 'all'])
    @include('businessanalysis.baRevenuePercentItem', ['title' => 'Árbevétel típus százalék', 'chartId' => 'year1', 'witch' => 'year'])
    @include('businessanalysis.baRevenuePercentItem', ['title' => 'Az elmúlt 30 nap árbevétel', 'chartId' => 'year2', 'witch' => 'month'])
    @include('businessanalysis.baRevenuePercentItem', ['title' => 'Az elmúlt 12 hónap értékei', 'chartId' => 'year3', 'witch' => 'amount'])
</div>

@section('scripts')

    <script src="{{ asset('/js/highchart/highchartLine.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/js/highchart/categoryUpload.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/js/highchart/chartDataUpload.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/js/highchart/highchartsTheme.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/js/highchart/highchartPie3D.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/js/highchart/highchartLanguage.js') }} " type="text/javascript"></script>

    <script type="text/javascript">

        $('[data-widget="pushmenu"]').PushMenu('collapse');

        var columnChartData = <?php echo (new App\Services\MonthstackedService)->getMonthsResults(12); ?>;
        var dataArr = $.map(columnChartData, function(value, key){
            return value
        })

        $(function () {

            hightchartsTheme();

            var chart_napi = highchartLine( 'year2', 'line', 400, categoryUpload(<?php echo RiportsClass::TurnoverLast30Days(); ?>, 'nap'),
                chartDataUpload(<?php echo RiportsClass::TurnoverLast30Days(); ?>, ['osszeg'], ['Bevétel']), 'Aktuális havi árbevétel', 'napi bontás', 'forint');

            function pieAllData() {

                var chartdata = [];

                chartdata.push({name: 'Készpénz', y: <?php echo (new App\Services\YearstackedService)->getSumPercent('cash'); ?> });
                chartdata.push({name: 'Kártya', y: <?php echo (new App\Services\YearstackedService)->getSumPercent('card'); ?> });
                chartdata.push({name: 'Szépkártya', y: <?php echo (new App\Services\YearstackedService)->getSumPercent('szcard'); ?> });

                return chartdata;

            }

            var chart_allpie = HighChartPie3D( 'year', 'pie', 45, 'Árbevétel típusok', 'Nyitás óta', pieAllData())

            function pieYearData() {

                var chartdata = [];

                chartdata.push({name: 'Készpénz', y: <?php echo (new App\Services\MonthstackedService)->getLastYear()->sum('cash'); ?> });
                chartdata.push({name: 'Kártya', y: <?php echo (new App\Services\MonthstackedService)->getLastYear()->sum('card'); ?> });
                chartdata.push({name: 'Szépkártya', y: <?php echo (new App\Services\MonthstackedService)->getLastYear()->sum('szcard'); ?> });

                return chartdata;

            }

            var chart_yearpie = HighChartPie3D( 'year1', 'pie', 45, 'Árbevétel típusok', 'Utolsó 12 hónap', pieYearData())


            function lastYearAmountChartCategory() {

                var categoryArray = [];

                for(i = 0; i < dataArr.length; i++) {

                    categoryArray.push(dataArr[i].ym);

                }

                return categoryArray.reverse();
            }

            function lastYearAmountChartData() {

                var chartDataArray = [];
                var revenue = [];
                var spend = [];
                var amount = [];

                var array = dataArr.reverse();

                for(i = 0; i < array.length; i++) {

                    revenue.push(array[i].revenue);
                    spend.push(array[i].spend);
                    amount.push(array[i].amount);

                }

                chartDataArray.push({name: 'Bevétel' , data: revenue});
                chartDataArray.push({name: 'Kiadás' , data: spend});
                chartDataArray.push({name: 'Eredmény' , data: amount});

                return chartDataArray;
            }


            Highcharts.chart('year3', {
                lang: highchartLanguage(),
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Bevétel - Kiadás - Eredmény'
                },
                subtitle: {
                    text: 'az elmúlt 12 hónapban'
                },
                xAxis: {
                    categories: lastYearAmountChartCategory(),
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Forint'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0; text-align: right;"><b>{point.y:.1f} Ft</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: lastYearAmountChartData()
            });

        });
    </script>
@endsection



