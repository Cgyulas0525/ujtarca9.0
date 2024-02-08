@section('content')
    @include('html.content-header', ['title' => $component->name])
    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        @include('components.html.edit.card')
    </div>
@endsection

