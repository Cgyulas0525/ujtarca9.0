<div class="row">
    <div class="col-lg-4 col-md-8 col-xs-12">
        @include('dashboard.dashboardResultBlock', ['title' => 'Pénzügy', 'title2' => date('Y')])
    </div>
    <div class="col-lg-4 col-md-8 col-xs-12">
        @include('dashboard.dashboardResultBlockOneYear', ['title' => 'Pénzügy', 'title2' => date('Y') - 1])
    </div>
    <div class="col-lg-4 col-md-8 col-xs-12">
        @include('dashboard.dashboardResultBlockAll', ['title' => 'Pénzügy', 'title2' => 'Összesen'])
    </div>
{{--    <div class="col-lg-4 col-md-8 col-xs-12">--}}
{{--        <div class="card card-widget widget-user-2">--}}
{{--            <!-- Add the bg color to the header using any of the bg-* classes -->--}}
{{--            <div class="widget-user-header bg-warning">--}}
{{--                <h3 class="text-center">Pénzügy</h3>--}}
{{--                <h3 class="text-center">{{date('Y')}}</h3>--}}
{{--            </div>--}}
{{--            <div class="card-footer p-0">--}}
{{--                <ul class="nav flex-column">--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{!! route('invoices.index') !!}" class="nav-link-black">--}}
{{--                            Költség <span class="float-right badge bg-primary">{{ number_format(DashboardController::invoicesAmountSumThisYear([date('Y')]),0,",",".") }} Ft</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{!! route('closures.index') !!}" class="nav-link-black">--}}
{{--                            Árbevétel <span class="float-right badge bg-info">{{ number_format(DashboardController::closuresAmountSumThisYear([date('Y')]),0,",",".") }} Ft</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{!! route('invoices.index') !!}" class="nav-link-black">--}}
{{--                            Egyenleg <span class="float-right badge bg-success">{{ number_format(DashboardController::financialResultThisYear([date('Y')]),0,",",".") }} Ft</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="#" class="nav-link-black">--}}
{{--                            Készpénz <span class="float-right badge bg-danger">842</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="#" class="nav-link-black">--}}
{{--                            Bankkártya <span class="float-right badge bg-danger">842</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="#" class="nav-link-black">--}}
{{--                            Szép kártya <span class="float-right badge bg-danger">842</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="#" class="nav-link-black">--}}
{{--                            Napi átlag <span class="float-right badge bg-danger">842</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>


{{--    <div class="col-lg-4 col-md-8 col-xs-12" style="margin-top: 10px;">--}}
{{--        <!-- small box -->--}}
{{--        <div class="box box-widget widget-user-2">--}}
{{--            <!-- Add the bg color to the header using any of the bg-* classes -->--}}
{{--            <div class="widget-user-header">--}}
{{--                <a href="{!! route('szamlas.index') !!}"><img src={{ URL::asset('/public/img/menu/szamla.jpg')}} class="penztarkep" ></a>--}}
{{--            </div>--}}
{{--            <div class="panel-footer">--}}
{{--                <ul class="nav nav-stacked">--}}
{{--                    <li><a href="{!! route('szamlas.index') !!}">{{ date('Y') - 1 }} Költség--}}
{{--                            <span class="pull-right badge bg-aqua"> {{ number_format( App\Classes\SzamlaClass::idoszakEvOsszKoltseg(--}}
{{--                                                               date('Y-m-d', strtotime('first day of january last year')),--}}
{{--                                                               date('Y-m-d', strtotime('last day of december last year'))--}}
{{--                                 ), 0, ",", "." ) }} Ft--}}
{{--                            </span></a></li>--}}
{{--                    <li><a href="{!! route('zaras.index') !!}">{{ date('Y') - 1 }} myPos--}}
{{--                            <span class="pull-right badge bg-green">{{ number_format(Zaras::idoszakBankkartyaOsszesen(--}}
{{--                                                               date('Y-m-d', strtotime('first day of january last year')),--}}
{{--                                                               date('Y-m-d', strtotime('last day of december last year')),--}}
{{--                                                               'kartya'--}}
{{--                                 ), 0, ",", "." ) }} Ft--}}
{{--                            </span></a></li>--}}
{{--                    <li><a href="{!! route('zaras.index') !!}">{{ date('Y') - 1 }} SZÉP kártya--}}
{{--                            <span class="pull-right badge bg-green">{{ number_format(Zaras::idoszakBankkartyaOsszesen(--}}
{{--                                                               date('Y-m-d', strtotime('first day of january last  year')),--}}
{{--                                                               date('Y-m-d', strtotime('last day of december last year')),--}}
{{--                                                               'szep'--}}
{{--                                 ), 0, ",", "." ) }} Ft--}}
{{--                            </span></a></li>--}}
{{--                    <li><a href="{!! route('zaras.index') !!}">{{ date('Y') - 1 }} Készpénz--}}
{{--                            <span class="pull-right badge bg-green">{{ number_format(Zaras::idoszakKeszpenzOsszesen(--}}
{{--                                                               date('Y-m-d', strtotime('first day of january last year')),--}}
{{--                                                               date('Y-m-d', strtotime('last day of december last year'))--}}
{{--                                ), 0, ",", "." ) }} Ft</span></a></li>--}}
{{--                    <li><a href="{!! route('zaras.index') !!}">{{ date('Y') - 1 }} Árbevétel--}}
{{--                            <span class="pull-right badge bg-green">{{ number_format(Zaras::idoszakArbevetel(--}}
{{--                                                               date('Y-m-d', strtotime('first day of january last year')),--}}
{{--                                                               date('Y-m-d', strtotime('last day of december last year'))--}}
{{--                                ), 0, ",", "." ) }} Ft</span></a></li>--}}
{{--                    <li><a href="{!! route('szamlas.index') !!}">{{ date('Y') - 1 }} Egyenleg--}}
{{--                            <span class="pull-right badge bg-red">{{ number_format((Zaras::idoszakArbevetel(--}}
{{--                                                               date('Y-m-d', strtotime('first day of january last year')),--}}
{{--                                                               date('Y-m-d', strtotime('last day of december last year'))--}}
{{--                                ) - App\Classes\SzamlaClass::idoszakEvOsszKoltseg(--}}
{{--                                                               date('Y-m-d', strtotime('first day of january last year')),--}}
{{--                                                               date('Y-m-d', strtotime('last day of december last year'))--}}
{{--                                 )), 0, ",", "." ) }} Ft</span></a></li>--}}
{{--                    <li><a href="{!! route('szamlas.index') !!}">{{ date('Y') - 1 }} Napi átlag bevétel--}}
{{--                            <span class="pull-right badge bg-red">{{ number_format((App\Models\Zaras::whereBetween('datum', [date('Y-m-d', strtotime('first day of january last year')),--}}
{{--                                                               date('Y-m-d', strtotime('last day of december last year'))])->get()->sum('osszeg') / App\Models\Zaras::whereBetween('datum', [date('Y-m-d', strtotime('first day of january last year')),--}}
{{--                                                               date('Y-m-d', strtotime('last day of december last year'))])->count()), 0, ",", "." ) }} Ft</span></a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="col-lg-4 col-md-8 col-xs-12" style="margin-top: 10px;">--}}
{{--        <!-- small box -->--}}
{{--        <div class="box box-widget widget-user-2">--}}
{{--            <!-- Add the bg color to the header using any of the bg-* classes -->--}}
{{--            <div class="widget-user-header">--}}
{{--                <a href="{!! route('penztarIndit') !!}"><img src={{ URL::asset('/public/img/menu/penztar.png')}} class="penztarkep" ></a>--}}
{{--            </div>--}}
{{--            <div class="panel-footer">--}}
{{--                <ul class="nav nav-stacked">--}}
{{--                    <li><a href="{!! route('szamlas.index') !!}">Össz Költség--}}
{{--                            <span class="pull-right badge bg-aqua"> {{ number_format( App\Classes\SzamlaClass::idoszakEvOsszKoltseg(--}}
{{--                                                               date('Y-m-d', strtotime('first day of january 2021')),--}}
{{--                                                               date('Y-m-d', strtotime('last day of december this year'))--}}
{{--                                 ), 0, ",", "." ) }} Ft--}}
{{--                            </span></a></li>--}}
{{--                    <li><a href="{!! route('zaras.index') !!}">Össz myPos--}}
{{--                            <span class="pull-right badge bg-green">{{ number_format(Zaras::idoszakBankkartyaOsszesen(--}}
{{--                                                               date('Y-m-d', strtotime('first day of january 2021')),--}}
{{--                                                               date('Y-m-d', strtotime('last day of december this year')),--}}
{{--                                                               'kartya'--}}
{{--                                 ), 0, ",", "." ) }} Ft--}}
{{--                            </span></a></li>--}}
{{--                    <li><a href="{!! route('zaras.index') !!}">Össz SZÉP kártya--}}
{{--                            <span class="pull-right badge bg-green">{{ number_format(Zaras::idoszakBankkartyaOsszesen(--}}
{{--                                                               date('Y-m-d', strtotime('first day of january 2021')),--}}
{{--                                                               date('Y-m-d', strtotime('last day of december this year')),--}}
{{--                                                               'szep'--}}
{{--                                 ), 0, ",", "." ) }} Ft--}}
{{--                            </span></a></li>--}}
{{--                    <li><a href="{!! route('zaras.index') !!}">Össz Készpénz--}}
{{--                            <span class="pull-right badge bg-green">{{ number_format(Zaras::idoszakKeszpenzOsszesen(--}}
{{--                                                               date('Y-m-d', strtotime('first day of january 2021')),--}}
{{--                                                               date('Y-m-d', strtotime('last day of december this year'))--}}
{{--                                ), 0, ",", "." ) }} Ft</span></a></li>--}}
{{--                    <li><a href="{!! route('zaras.index') !!}">Össz Árbevétel--}}
{{--                            <span class="pull-right badge bg-green">{{ number_format(Zaras::idoszakArbevetel(--}}
{{--                                                               date('Y-m-d', strtotime('first day of january 2021')),--}}
{{--                                                               date('Y-m-d', strtotime('last day of december this year'))--}}
{{--                                ), 0, ",", "." ) }} Ft</span></a></li>--}}
{{--                    <li><a href="{!! route('szamlas.index') !!}">Össz Egyenleg--}}
{{--                            <span class="pull-right badge bg-red">{{ number_format((Zaras::idoszakArbevetel(--}}
{{--                                                               date('Y-m-d', strtotime('first day of january 2021')),--}}
{{--                                                               date('Y-m-d', strtotime('last day of december this year'))--}}
{{--                                ) - App\Classes\SzamlaClass::idoszakEvOsszKoltseg(--}}
{{--                                                               date('Y-m-d', strtotime('first day of january 2021')),--}}
{{--                                                               date('Y-m-d', strtotime('last day of december this year'))--}}
{{--                                 )), 0, ",", "." ) }} Ft</span></a></li>--}}
{{--                    <li><a href="{!! route('szamlas.index') !!}">Napi átlag bevétel--}}
{{--                            <span class="pull-right badge bg-red">{{ number_format((App\Models\Zaras::whereBetween('datum', [date('Y-m-d', strtotime('first day of january 2021')),--}}
{{--                                                               date('Y-m-d', strtotime('last day of december this year'))])->get()->sum('osszeg') / App\Models\Zaras::whereBetween('datum', [date('Y-m-d', strtotime('first day of january 2021')),--}}
{{--                                                               date('Y-m-d', strtotime('last day of december this year'))])->count()), 0, ",", "." ) }} Ft</span></a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
