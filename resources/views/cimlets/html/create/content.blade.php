@section('content')
    @include('html.content-header', ['title' => __('Címlet')])
    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        @include('cimlets.html.create.card')
    </div>
@endsection
