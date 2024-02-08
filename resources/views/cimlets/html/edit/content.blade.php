@section('content')
    @include('html.content-header', ['title' => $cimlets->name])
    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        @include('cimlets.html.edit.card')
    </div>
@endsection

