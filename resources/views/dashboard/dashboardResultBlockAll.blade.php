<div class="card card-widget widget-user-2">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-warning">
        <h3 class="text-center">{{ $title }}</h3>
        <h3 class="text-center">{{ $title2 }}</h3>
    </div>
    <div class="card-footer p-0">
        <ul class="nav flex-column">
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Árbevétel',
                                                            'route' => 'closures.index',
                                                            'value' => number_format(DashboardController::closuresAmountSumAll(),0,",","."),
                                                            'class' => 'bg-primary'])
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Költség',
                                                            'route' => 'invoices.index',
                                                            'value' => number_format(DashboardController::invoicesAmountSumall(),0,",","."),
                                                            'class' => 'bg-primary'])
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Egyenleg',
                                                            'route' => 'invoices.index',
                                                            'value' => number_format(DashboardController::closuresAmountSumAll() - DashboardController::invoicesAmountSumall(),0,",","."),
                                                            'class' => 'bg-danger'])
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Készpénz',
                                                            'route' => 'invoices.index',
                                                            'value' => number_format(DashboardController::cashAll(),0,",","."),
                                                            'class' => 'bg-primary'])
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Bankkártya',
                                                            'route' => 'invoices.index',
                                                            'value' => number_format(DashboardController::cardAll(),0,",","."),
                                                            'class' => 'bg-primary'])
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Szép kártya',
                                                            'route' => 'invoices.index',
                                                            'value' => number_format(DashboardController::szcardAll(),0,",","."),
                                                            'class' => 'bg-primary'])
            @include('dashboard.dashboardResultBlockItem', ['title' => 'Napi átlag',
                                                            'route' => 'invoices.index',
                                                            'value' => number_format(DashboardController::averigeAll(),0,",","."),
                                                            'class' => 'bg-danger'])
        </ul>
    </div>
</div>
