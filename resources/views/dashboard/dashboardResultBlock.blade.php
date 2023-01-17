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
                                                                'value' => number_format(DashboardController::closuresAmountSumThisYear([date('Y')]),0,",","."),
                                                                'class' => 'bg-primary'])
                @include('dashboard.dashboardResultBlockItem', ['title' => 'Költség',
                                                                'route' => 'invoices.index',
                                                                'value' => number_format(DashboardController::invoicesAmountSumThisYear([date('Y')]),0,",","."),
                                                                'class' => 'bg-primary'])
                @include('dashboard.dashboardResultBlockItem', ['title' => 'Egyenleg',
                                                                'route' => 'invoices.index',
                                                                'value' => number_format(DashboardController::financialResultThisYear([date('Y')]),0,",","."),
                                                                'class' => 'bg-danger'])
                @include('dashboard.dashboardResultBlockItem', ['title' => 'Készpénz',
                                                                'route' => 'invoices.index',
                                                                'value' => number_format(DashboardController::cashThisYear(date('Y-m-d', strtotime('first day of January this year')),
                                                                                                                           date('Y-m-d', strtotime('last day this year'))),0,",","."),
                                                                'class' => 'bg-primary'])
                @include('dashboard.dashboardResultBlockItem', ['title' => 'Bankkártya',
                                                                'route' => 'invoices.index',
                                                                'value' => number_format(DashboardController::cardThisYear(date('Y-m-d', strtotime('first day of January this year')),
                                                                                                                           date('Y-m-d', strtotime('last day this year'))),0,",","."),
                                                                'class' => 'bg-primary'])
                @include('dashboard.dashboardResultBlockItem', ['title' => 'Szép kártya',
                                                                'route' => 'invoices.index',
                                                                'value' => number_format(DashboardController::szcardThisYear(date('Y-m-d', strtotime('first day of January this year')),
                                                                                                                           date('Y-m-d', strtotime('last day this year'))),0,",","."),
                                                                'class' => 'bg-primary'])
                @include('dashboard.dashboardResultBlockItem', ['title' => 'Napi átlag',
                                                                'route' => 'invoices.index',
                                                                'value' => number_format(DashboardController::averigeThisYear(date('Y-m-d', strtotime('first day of January this year')),
                                                                                                                           date('Y-m-d', strtotime('last day this year'))),0,",","."),
                                                                'class' => 'bg-danger'])
            </ul>
        </div>
    </div>
