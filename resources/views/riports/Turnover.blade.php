@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    <link rel="stylesheet" href="public/css/Highcharts.css">
    @include('layouts.costumcss')
@endsection

@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary" >
            <div class="box-body">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <section class="content-header">
                        <h4>Árbevétel</h4>
                    </section>
                    @include('flash::message')
                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body"  >
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header p-2">
                                            <ul class="nav nav-pills">
                                                <li class="nav-item"><a class="nav-link active" href="#napi" data-toggle="tab">Napi</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#heti" data-toggle="tab">Heti</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#havi" data-toggle="tab">Havi</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#fizetesi" data-toggle="tab">Fizetési mód</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#twoyear" data-toggle="tab">Elmúlt 2 év</a></li>
                                                <li class="nav-item"><a class="nav-link" href="#bevki" data-toggle="tab">Bevétel/Kiadás</a></li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="napi">
                                                    <section class="content-header">
                                                        <h1> Árbevétel alakulás az elmúlt 30 napban</h1>
                                                    </section>
                                                    <figure class="highcharts-figure">
                                                        <div id="haviNapiArbevetel"></div>
                                                    </figure>
                                                </div>
                                                <div class="tab-pane" id="heti">
                                                    <section class="content-header">
                                                        <h1> Árbevétel alakulás heti bontásban</h1>
                                                    </section>
                                                    <figure class="highcharts-figure">
                                                        <div id="hetiArbevetel"></div>
                                                    </figure>
                                                </div>
                                                <div class="tab-pane" id="havi">
                                                    <section class="content-header">
                                                        <h1> Árbevétel alakulás havi bontásban</h1>
                                                    </section>
                                                    <figure class="highcharts-figure">
                                                        <div id="haviArbevetel"></div>
                                                    </figure>
                                                </div>
                                                <div class="tab-pane" id="fizetesi">
                                                    <section class="content-header">
                                                        <h1>Fizetési mód az elmúlt 30 napban</h1>
                                                    </section>
                                                    <figure class="highcharts-figure">
                                                        <div id="fizetesimod"></div>
                                                    </figure>
                                                </div>
                                                <div class="tab-pane" id="twoyear">
                                                    <section class="content-header">
                                                        <h1>Bevétel az elmúlt 2 évben</h1>
                                                    </section>
                                                    <figure class="highcharts-figure">
                                                        <div id="twoyears"></div>
                                                    </figure>
                                                </div>
                                                <div class="tab-pane" id="bevki">
                                                    <section class="content-header">
                                                        <h1>Bevétel/Kiadás az elmúlt évben</h1>
                                                    </section>
                                                    <figure class="highcharts-figure">
                                                        <div id="bevkiad"></div>
                                                    </figure>
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
    </div>
@endsection

@section('scripts')

    @include('layouts.highcharts_js')
    @include("hsjs.hsjs")

    @include('functions.ajax_js')

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            function LineChartKategoria(data){
                kategoria = [];
                for (i = 0; i < data.length; i++){
                    kategoria.push(data[i].nap);
                }
                return kategoria;
            }

            function LineChartData(data, mi){
                chartdata = [];
                cdata = [];
                for (i = 0; i < data.length; i++){
                    cdata.push(parseInt(data[i].osszeg));
                }
                chartdata.push({name: mi, data: cdata});
                return chartdata;
            }

            function LineChartDataPM(data, mi){
                chartdata = [];
                cash = [];
                card = [];
                szcard = [];
                for (i = 0; i < data.length; i++){
                    cash.push(parseInt(data[i].cash));
                    card.push(parseInt(data[i].card))
                    szcard.push(parseInt(data[i].szcard))
                }
                chartdata.push({name: 'Készpénz', data: cash});
                chartdata.push({name: 'Kártya', data: card});
                chartdata.push({name: 'Szép kártya', data: szcard});
                return chartdata;
            }

            function LineChartDataTwo(data, mi){
                chartdata = [];
                cash = [];
                card = [];
                for (i = 0; i < data.length; i++){
                    cash.push(parseInt(data[i].elso));
                    card.push(parseInt(data[i].masodik))
                }
                chartdata.push({name: 'Kiadás', data: cash});
                chartdata.push({name: 'Bevétel', data: card});
                return chartdata;
            }


            var chart_napi = highchartLine( 'haviNapiArbevetel', 'line', 450, LineChartKategoria(<?php echo RiportsClass::TurnoverLast30Days(); ?>), LineChartData(<?php echo RiportsClass::TurnoverLast30Days(); ?>, ''), 'Aktuális havi árbevétel', 'napi bontás', 'forint');
            var chart_heti = highchartLine( 'hetiArbevetel', 'line', 450, LineChartKategoria(<?php echo RiportsClass::TurnoverLast26Weeks(); ?>), LineChartData(<?php echo RiportsClass::TurnoverLast26Weeks(); ?>, ''), 'Havi árbevétel', 'havi bontás', 'forint');
            var chart_havi = highchartLine( 'haviArbevetel', 'line', 450, LineChartKategoria(<?php echo RiportsClass::TurnoverLast12Month(); ?>), LineChartData(<?php echo RiportsClass::TurnoverLast12Month(); ?>, ''), 'Heti árbevétel', 'heti bontás', 'forint');
            var chart_fizm = highchartLine( 'fizetesimod', 'line', 450, LineChartKategoria(<?php echo RiportsClass::PaymentMethodLast30days(); ?>), LineChartDataPM(<?php echo RiportsClass::PaymentMethodLast30days(); ?>, ''), 'Fizetési mód', 'napi bontás', 'forint');
            var chart_twoy = highchartLine( 'twoyears', 'line', 450, LineChartKategoria(<?php echo RiportsClass::TurnoverLastTwoYears(); ?>), LineChartDataTwo(<?php echo RiportsClass::TurnoverLastTwoYears(); ?>, ''), 'Fizetési mód', 'napi bontás', 'forint');
            var chart_bevk = highchartLine( 'bevkiad', 'line', 450, LineChartKategoria(<?php echo RiportsClass::monthInviocesResult(); ?>), LineChartDataTwo(<?php echo RiportsClass::monthInviocesResult(); ?>, ''), 'Fizetési mód', 'napi bontás', 'forint');

        });
    </script>
@endsection

