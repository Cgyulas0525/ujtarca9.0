@section('content')
    @include('html.content-header', ['title' => __('Mennyiségi egység')])
    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        @include('quantities.html.create.card')
    </div>
@endsection
