@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <section class="content-header">
                        <div class="form-group col-sm-12">
                            <div class="row">
                                <div class="col-sm-2">
                                    <h4>Megrendelések</h4>
                                </div>
                                @include('orders.html.index.order-type-enum')
                                @include('orders.html.index.order-status-enum')
                            </div>
                        </div>
                    </section>
                    @include('flash::message')
                    @include('html.index.content-table')
                </div>
            </div>
        </div>
    </div>
@endsection
