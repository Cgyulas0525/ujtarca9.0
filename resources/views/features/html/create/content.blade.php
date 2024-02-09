@section('content')
    @include('html.content-header', ['title' => __('Jellemző')])
    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        @include('features.html.create.card')
    </div>
@endsection
