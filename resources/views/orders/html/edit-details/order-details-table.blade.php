<div class="col-lg-12 col-md-12 col-xs-12 mt-n4">
    <section class="content-header">
        <h1 class="pull-left">Tételek</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        @include('flash::message')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered detailstable w-100">
                        @include('orderdetails.table')
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center">
        </div>
    </div>
</div>

