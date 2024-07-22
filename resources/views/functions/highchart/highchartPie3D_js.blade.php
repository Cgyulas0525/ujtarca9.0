<script type="text/javascript">
    function HighChartPie3D( renderTo, type, alpha, chartTitleText, chartSubtitleText, pieData){
        var chart = Highcharts.chart( renderTo, {
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
                type: type,
                options3d: {
                    enabled: true,
                    alpha: alpha,
                    beta: 0
                }
            },
            title: {
                text: chartTitleText,
                align: 'left'
            },
            subtitle: {
                text: chartSubtitleText,
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
                type: type,
                name: 'Share',
                data: pieData
            }]
        });
        return chart;
    }
</script>

