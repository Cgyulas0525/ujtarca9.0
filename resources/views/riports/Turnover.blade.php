@extends('layouts.appblack')

@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    <link rel="stylesheet" href="public/css/Highcharts.css">
    @include('app-scaffold.css.costumcss')
@endsection

@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <section class="content-header">
                        <h4>Árbevétel</h4>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header p-2">
                                            <ul class="nav nav-pills">
                                                <li class="nav-item"><a class="nav-link active" href="#napi"
                                                                        data-toggle="tab">Napi</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#heti" data-toggle="tab">Heti</a>
                                                </li>
                                                <li class="nav-item"><a class="nav-link" href="#havi" data-toggle="tab">Havi</a>
                                                </li>
                                                <li class="nav-item"><a class="nav-link" href="#fizetesi"
                                                                        data-toggle="tab">Fizetési mód</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#twoyear"
                                                                        data-toggle="tab">Elmúlt 2 év</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#bevki"
                                                                        data-toggle="tab">Bevétel/Kiadás</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#bevkiheti"
                                                                        data-toggle="tab">Heti Bevétel/Kiadás</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                @include('riports.TurnoverItem', ['title' => 'Árbevétel alakulás az elmúlt 30 napban',
                                                                                  'id' => 'napi',
                                                                                  'tabPane' => 'active tab-pane',
                                                                                  'chartId' => 'haviNapiArbevetel'])
                                                @include('riports.TurnoverItem', ['title' => 'Árbevétel alakulás heti bontásban',
                                                                                  'id' => 'heti',
                                                                                  'tabPane' => 'tab-pane',
                                                                                  'chartId' => 'hetiArbevetel'])
                                                @include('riports.TurnoverItem', ['title' => 'Árbevétel alakulás havi bontásban',
                                                                                  'id' => 'havi',
                                                                                  'tabPane' => 'tab-pane',
                                                                                  'chartId' => 'haviArbevetel'])
                                                @include('riports.TurnoverItem', ['title' => 'Fizetési mód az elmúlt 30 napban',
                                                                                  'id' => 'fizetesi',
                                                                                  'tabPane' => 'tab-pane',
                                                                                  'chartId' => 'fizetesimod'])
                                                @include('riports.TurnoverItem', ['title' => 'Bevétel alakulás az elmúlt 2 évben',
                                                                                  'id' => 'twoyear',
                                                                                  'tabPane' => 'tab-pane',
                                                                                  'chartId' => 'twoyears'])
                                                @include('riports.TurnoverItem', ['title' => 'Bevétel/Kiadás az elmúlt évben',
                                                                                  'id' => 'bevki',
                                                                                  'tabPane' => 'tab-pane',
                                                                                  'chartId' => 'bevkiad'])
                                                @include('riports.TurnoverItem', ['title' => 'Heti Bevétel/Kiadás az adott időszakban',
                                                                                  'id' => 'bevkiheti',
                                                                                  'tabPane' => 'tab-pane',
                                                                                  'chartId' => 'bevkiadheti'])

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    @include('functions.highchart.highchartLine_js')
    @include('functions.highchart.categoryUpload_js')
    @include('functions.highchart.chartDataUpload_js')
    @include('functions.highchart.highchartsTheme_js')

    <script type="text/javascript">
        $(function () {

            hightchartsTheme();

            var chart_napi = highchartLine('haviNapiArbevetel', 'line', 450, categoryUpload(<?php echo ReportsClass::TurnoverLast30Days(); ?>, 'nap'),
                chartDataUpload(<?php echo ReportsClass::TurnoverLast30Days(); ?>, ['osszeg'], ['Bevétel']), 'Aktuális havi árbevétel', 'napi bontás', 'forint');

            var chart_heti = highchartLine('hetiArbevetel', 'line', 450, categoryUpload(<?php echo ReportsClass::TurnoverLast26Weeks(); ?>, 'nap'),
                chartDataUpload(<?php echo ReportsClass::TurnoverLast26Weeks(); ?>, ['osszeg'], ['Bevétel']), 'Havi árbevétel', 'havi bontás', 'forint');

            var chart_havi = highchartLine('haviArbevetel', 'line', 450, categoryUpload(<?php echo ReportsClass::TurnoverLast12Month(); ?>, 'nap'),
                chartDataUpload(<?php echo ReportsClass::TurnoverLast12Month(); ?>, ['osszeg'], ['Bevétel']), 'Heti árbevétel', 'heti bontás', 'forint');

            var chart_fizm = highchartLine('fizetesimod', 'line', 450, categoryUpload(<?php echo ReportsClass::PaymentMethodLast30days(); ?>, 'nap'),
                chartDataUpload(<?php echo ReportsClass::PaymentMethodLast30days(); ?>, ['card', 'szcard', 'dayCash'], ['Kártya', 'SZÉP kártya', 'Készpénz']), 'Fizetési mód', 'napi bontás', 'forint');

            var chart_twoy = highchartLine('twoyears', 'line', 450, categoryUpload(<?php echo ReportsClass::TurnoverLastTwoYears(); ?>, 'nap'),
                chartDataUpload(<?php echo ReportsClass::TurnoverLastTwoYears(); ?>, ['elso', 'masodik'], ['-1 év', '-2 év']), 'Fizetési mód', 'napi bontás', 'forint');
            var chart_bevk = highchartLine('bevkiad', 'line', 450, categoryUpload(<?php echo ReportsClass::monthInvoicesResult(); ?>, 'nap'),
                chartDataUpload(<?php echo ReportsClass::monthInvoicesResult(); ?>, ['elso', 'masodik'], ['Kiadás', 'Bevétel']), 'Fizetési mód', 'napi bontás', 'forint');
            var chart_bevkheti = highchartLine('bevkiadheti', 'line', 450, categoryUpload(<?php echo ReportsClass::weekInvoicesResult(); ?>, 'nap'),
                chartDataUpload(<?php echo ReportsClass::weekInvoicesResult(); ?>, ['elso', 'masodik'], ['Kiadás', 'Bevétel']), 'Fizetési mód', 'napi bontás', 'forint');

            $('#period').change(function () {
                let period = parseInt($(this).val());
                let data = [];
                switch (period) {
                    case 0:
                        data = <?php echo ReportsClass::weekInvoicesResult(1); ?>;
                        break;
                    case 1:
                        data = <?php echo ReportsClass::weekInvoicesResult(3); ?>;
                        break;
                    case 2:
                        data = <?php echo ReportsClass::weekInvoicesResult(6); ?>;
                        break;
                    case 3:
                        data = <?php echo ReportsClass::weekInvoicesResult(12); ?>;
                        break;
                    default:
                        alert('Ilyen nincs!');
                }
                chart_bevkheti = highchartLine('bevkiadheti', 'line', 450, categoryUpload(data, 'nap'),
                    chartDataUpload(data, ['elso', 'masodik'], ['Kiadás', 'Bevétel']), 'Fizetési mód', 'napi bontás', 'forint');
                ;
            });

        });
    </script>
@endsection

