<div class="col-lg-8 col-md-6 col-xs-12">

    <div class="card card-primary">
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
        </div>
        <!-- /.footer -->
    </div>
</div>
