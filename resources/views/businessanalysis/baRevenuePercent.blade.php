<div class="row">
    @include('businessanalysis.baRevenuePercentItem', ['title' => 'Árbevétel típus százalék', 'chartId' => 'year'])
    @include('businessanalysis.baRevenuePercentItem', ['title' => 'Árbevétel típus százalék', 'chartId' => 'year1'])
    @include('businessanalysis.baRevenuePercentItem', ['title' => 'Árbevétel típus százalék', 'chartId' => 'year2'])
    @include('businessanalysis.baRevenuePercentItem', ['title' => 'Árbevétel típus százalék', 'chartId' => 'year3'])
</div>

@section('scripts')

    <script src="{{ asset('/public/js/highchart/highchartLine.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/public/js/highchart/categoryUpload.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/public/js/highchart/chartDataUpload.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/public/js/highchart/highchartsTheme.js') }} " type="text/javascript"></script>

    <script type="text/javascript">

        var chartdata = [];

        $(function () {

            hightchartsTheme();

            var chart_napi = highchartLine( 'year', 'line', 400, categoryUpload(<?php echo RiportsClass::TurnoverLast30Days(); ?>, 'nap'),
                chartDataUpload(<?php echo RiportsClass::TurnoverLast30Days(); ?>, ['osszeg'], ['Bevétel']), 'Aktuális havi árbevétel', 'napi bontás', 'forint');

            function pieData() {

                chartdata = [];

                chartdata.push({name: 'Készpénz', y: <?php echo App\Services\YearstackedService::getSumPercent('cash'); ?> });
                chartdata.push({name: 'Kártya', y: <?php echo App\Services\YearstackedService::getSumPercent('card'); ?> });
                chartdata.push({name: 'Szépkártya', y: <?php echo App\Services\YearstackedService::getSumPercent('szcard'); ?> });

                console.log(chartdata);

                return chartdata;

            }

            Highcharts.chart('year1', {
                lang: {
                    loading: 'Betöltés...',
                    viewFullscreen: 'Teljes képernyő',
                    exitFullscreen: 'Kilépés a teljes képernyőből',
                    months: ['január', 'február', 'március', 'április', 'május', 'június',
                        'július', 'augusztus', 'szeptember', 'október', 'november', 'december'],
                    shortMonths: ['jan', 'febr', 'márc', 'ápr', 'máj', 'jún', 'júl', 'aug', 'szept', 'okt', 'nov', 'dec'],
                    weekdays: ['vasárnap', 'hétfő', 'kedd', 'szerda', 'csütörtök', 'péntek', 'szombat'],
                    exportButtonTitle: "Exportál",
                    printButtonTitle: "Importál",
                    rangeSelectorFrom: "ettől",
                    rangeSelectorTo: "eddig",
                    rangeSelectorZoom: "mutat:",
                    downloadCSV: 'Letöltés CSV fileként',
                    downloadXLS: 'Letöltés XLS fileként',
                    downloadPNG: 'Letöltés PNG képként',
                    downloadJPEG: 'Letöltés JPEG képként',
                    downloadPDF: 'Letöltés PDF dokumentumként',
                    downloadSVG: 'Letöltés SVG formátumban',
                    resetZoom: "Visszaállít",
                    resetZoomTitle: "Visszaállít",
                    thousandsSep: "",
                    decimalPoint: ',',
                    viewData: 'Táblázat',
                    printChart: 'Nyomtatás'
                },
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    }
                },
                title: {
                    text: 'Árbevétel típusok',
                    align: 'left'
                },
                subtitle: {
                    text: 'Nyitás óta',
                    align: 'left'
                },
                accessibility: {
                    point: {
                        valueSuffix: '%'
                    }
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}'
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Share',
                    data: pieData()
                }]
            });

            {{--var chart_napi1 = highchartLine( 'year1', 'line', 450, categoryUpload(<?php echo RiportsClass::TurnoverLast30Days(); ?>, 'nap'),--}}
            {{--    chartDataUpload(<?php echo RiportsClass::TurnoverLast30Days(); ?>, ['osszeg'], ['Bevétel']), 'Aktuális havi árbevétel', 'napi bontás', 'forint');--}}

           var chart_napi2 = highchartLine( 'year2', 'line', 450, categoryUpload(<?php echo RiportsClass::TurnoverLast30Days(); ?>, 'nap'),
                chartDataUpload(<?php echo RiportsClass::TurnoverLast30Days(); ?>, ['osszeg'], ['Bevétel']), 'Aktuális havi árbevétel', 'napi bontás', 'forint');

           var chart_napi3 = highchartLine( 'year3', 'line', 450, categoryUpload(<?php echo RiportsClass::TurnoverLast30Days(); ?>, 'nap'),
                chartDataUpload(<?php echo RiportsClass::TurnoverLast30Days(); ?>, ['osszeg'], ['Bevétel']), 'Aktuális havi árbevétel', 'napi bontás', 'forint');


        });
    </script>
@endsection



