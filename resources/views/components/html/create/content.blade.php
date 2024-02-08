@section('content')
    @include('html.content-header', ['title' => __('Összetevő')])
    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        @include('components.html.create.card')
    </div>
@endsection
