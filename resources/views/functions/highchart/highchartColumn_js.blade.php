<script type="text/javascript">
    function HighChartColumn(
        renderTo, type, category, data, height, borderRadius, borderColor, borderWidth, titleText, subtitleText, yAxisTitle, inverted, polar) {
        var chart = Highcharts.chart({
            lang: {
                loading: 'Betöltés...',
                viewFullscreen: 'Teljes képernyő',
                exitFullscreen: 'Kilépés a teljes képernyőből',
                months: ['január', 'február', 'március', 'április', 'május','június',
                    'július', 'augusztus', 'szeptember', 'október', 'november', 'december'],
                shortMonths:  ['jan', 'febr', 'márc', 'ápr', 'máj', 'jún', 'júl', 'aug', 'szept', 'okt', 'nov', 'dec'],
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
                renderTo: renderTo,
                height: height,
                backgroundColor: '#EDE6E6',
                borderRadius: borderRadius,
                borderColor: borderColor,
                borderWidth: borderWidth,
                inverted: inverted,
                polar: polar,
                type: type
            },
            title: {
                text: titleText
            },

            subtitle: {
                text: subtitleText
            },

            xAxis: {
                categories: category
            },
            yAxis: {
                min: 0,
                title: {
                    text: yAxisTitle
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
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

            series: data

        });
        return chart;
    }
</script>

