@section('content')
    @include('html.content-header', ['title' => $quantities->name])
    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        @include('quantities.html.edit.card')
    </div>
@endsection
