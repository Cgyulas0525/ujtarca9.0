@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    @include('html.index.content-header', ['title' => __('Összetevők')])
                    @include('flash::message')
                    @include('html.index.content-table')
                </div>
            </div>
        </div>
    </div>
@endsection

