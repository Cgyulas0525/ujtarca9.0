@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    @include('invoices.html.index.content-header')
                    @include('flash::message')
                    @include('invoices.html.index.table')
                </div>
            </div>
        </div>
    </div>
@endsection
