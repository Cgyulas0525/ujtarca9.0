<div class="col-lg-3 col-md-6 col-xs-12">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <figure class="highcharts-figure w-100">
                    <div id="{{ $chartId }}"></div>
                </figure>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer p-0">
            <ul class="nav nav-pills flex-column">
                @if ($witch === 'all' || $witch === 'year')
                    @include('businessanalysis.baRevenuePercentItemNavItem', ['title' => 'Kártya', 'field' => 'card', 'c1' => 'float-right text-danger', 'icon' => 'fas fa-arrow-down text-sm', 'witch' => $witch])
                    @include('businessanalysis.baRevenuePercentItemNavItem', ['title' => 'Szépkártya', 'field' => 'szcard', 'c1' => 'float-right text-warning', 'icon' => 'fas fa-arrow-up text-sm', 'witch' => $witch])
                    @include('businessanalysis.baRevenuePercentItemNavItem', ['title' => 'Készpénz', 'field' => 'cash', 'c1' => 'float-right text-success', 'icon' => 'fas fa-arrow-left text-sm', 'witch' => $witch])
                @endif
                @if ($witch === 'month')
                    @include('businessanalysis.baRevenueAmountDailySumNavItem', ['title' => 'Bevétel', 'field' => 'bevetel', 'c1' => 'float-right text-danger', 'icon' => 'fas fa-arrow-down text-sm', 'witch' => $witch])
                    @include('businessanalysis.baRevenueAmountDailySumNavItem', ['title' => 'Kiadás', 'field' => 'kiadas', 'c1' => 'float-right text-warning', 'icon' => 'fas fa-arrow-up text-sm', 'witch' => $witch])
                    @include('businessanalysis.baRevenueAmountDailySumNavItem', ['title' => 'Eredmény', 'field' => 'eredmeny', 'c1' => 'float-right text-success', 'icon' => 'fas fa-arrow-left text-sm', 'witch' => $witch])
                @endif
                @if ($witch === 'amount')
                    @include('businessanalysis.baRevenueAmountDailySumNavItem', ['title' => 'Bevétel', 'field' => 'bevetel', 'c1' => 'float-right text-danger', 'icon' => 'fas fa-arrow-down text-sm', 'witch' => $witch])
                    @include('businessanalysis.baRevenueAmountDailySumNavItem', ['title' => 'Kiadás', 'field' => 'kiadas', 'c1' => 'float-right text-warning', 'icon' => 'fas fa-arrow-up text-sm', 'witch' => $witch])
                    @include('businessanalysis.baRevenueAmountDailySumNavItem', ['title' => 'Eredmény', 'field' => 'eredmeny', 'c1' => 'float-right text-success', 'icon' => 'fas fa-arrow-left text-sm', 'witch' => $witch])
                @endif
            </ul>
        </div>
        <!-- /.footer -->
    </div>
</div>
    <!-- /.card -->

