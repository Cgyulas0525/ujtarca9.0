@section('content')
    @include('html.content-header', ['title' => $feature->name])
    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        @include('features.html.edit.card')
    </div>
@endsection

