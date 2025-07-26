<div class="card card-widget widget-user-2">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-warning">
        <div class="finance-button-container">
            @if (!is_null($values) && $values->year == date('Y'))
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <a href="#" class="btn btn-default finance-button weekBtn">Heti</a>

                    <a href="#" class="btn btn-default finance-button mountBtn">Havi</a>
                    <a href="#" class="btn btn-default finance-button yearBtn">Éves</a>
                </div>
            @else
                <h3 class="text-center">{{ $title2 }}</h3>
            @endif
        </div>
    </div>
    <div class="card-footer p-0">
        <ul class="nav flex-column">
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Árbevétel',
                                                            'route' => 'closures.index',
                                                            'value' => number_format(!is_null($values) ? $values->revenue : 0,0,",","."),
                                                            'class' => 'bg-primary',
                                                            'id' => 'arbevetel'])
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Költség',
                                                            'route' => 'invoices.index',
                                                            'value' => number_format(!is_null($values) ? $values->spend : 0,0,",","."),
                                                            'class' => 'bg-primary',
                                                            'id' => 'koltseg'])
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Egyenleg',
                                                            'route' => 'invoices.index',
                                                            'value' => number_format(!is_null($values) ? $values->result : 0,0,",","."),
                                                            'class' => 'bg-danger',
                                                            'id' => 'egyenleg'])
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Készpénz',
                                                            'route' => 'invoices.index',
                                                            'value' => number_format(!is_null($values) ? $values->cash : 0,0,",","."),
                                                            'class' => 'bg-primary',
                                                            'id' => 'kp'])
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Bankkártya',
                                                            'route' => 'invoices.index',
                                                            'value' => number_format(!is_null($values) ? $values->card : 0,0,",","."),
                                                            'class' => 'bg-primary',
                                                            'id' => 'kartya'])
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Szép kártya',
                                                            'route' => 'invoices.index',
                                                            'value' => number_format(!is_null($values) ? $values->szcard : 0,0,",","."),
                                                            'class' => 'bg-primary',
                                                            'id' => 'szkartya'])
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Napi átlag',
                                                            'route' => 'invoices.index',
                                                            'value' => number_format(!is_null($values) ? $values->average : 0,0,",","."),
                                                            'class' => 'bg-danger',
                                                            'id' => 'atlag'])
        </ul>
    </div>
</div>

