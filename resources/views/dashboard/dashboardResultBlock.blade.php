<div class="card card-widget widget-user-2">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-warning">
        <div class=" finance-button-container">
            <a href="#" class="btn btn-default finance-button yearBtn">Éves</a>
            <a href="#" class="btn btn-default finance-button mountBtn">Havi</a>
            <a href="#" class="btn btn-default finance-button weekBtn">Heti</a>
        </div>
{{--        <h3 class="text-center">{{ $title }}</h3>--}}
        <h3 class="text-center">{{ $title2 }}</h3>
    </div>
    <div class="card-footer p-0">
        <ul class="nav flex-column">
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Árbevétel',
                                                            'route' => 'closures.index',
                                                            'value' => number_format(DashboardController::closuresAmountSumThisYear([date('Y')]),0,",","."),
                                                            'class' => 'bg-primary',
                                                            'id' => 'arbevetel'])
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Költség',
                                                            'route' => 'invoices.index',
                                                            'value' => number_format(DashboardController::invoicesAmountSumThisYear([date('Y')]),0,",","."),
                                                            'class' => 'bg-primary',
                                                            'id' => 'koltseg'])
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Egyenleg',
                                                            'route' => 'invoices.index',
                                                            'value' => number_format(DashboardController::financialResultThisYear([date('Y')]),0,",","."),
                                                            'class' => 'bg-danger',
                                                            'id' => 'egyenleg'])
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Készpénz',
                                                            'route' => 'invoices.index',
                                                            'value' => number_format(DashboardController::cashThisYear(date('Y-m-d', strtotime('first day of January this year')),
                                                                                                                       date('Y-m-d', strtotime('last day this year'))),0,",","."),
                                                            'class' => 'bg-primary',
                                                            'id' => 'kp'])
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Bankkártya',
                                                            'route' => 'invoices.index',
                                                            'value' => number_format(DashboardController::cardThisYear(date('Y-m-d', strtotime('first day of January this year')),
                                                                                                                       date('Y-m-d', strtotime('last day this year'))),0,",","."),
                                                            'class' => 'bg-primary',
                                                            'id' => 'kartya'])
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Szép kártya',
                                                            'route' => 'invoices.index',
                                                            'value' => number_format(DashboardController::szcardThisYear(date('Y-m-d', strtotime('first day of January this year')),
                                                                                                                       date('Y-m-d', strtotime('last day this year'))),0,",","."),
                                                            'class' => 'bg-primary',
                                                            'id' => 'szkartya'])
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Napi átlag',
                                                            'route' => 'invoices.index',
                                                            'value' => number_format(DashboardController::averigeThisYear(date('Y-m-d', strtotime('first day of January this year')),
                                                                                                                       date('Y-m-d', strtotime('last day this year'))),0,",","."),
                                                            'class' => 'bg-danger',
                                                            'id' => 'atlag'])
        </ul>
    </div>
</div>

