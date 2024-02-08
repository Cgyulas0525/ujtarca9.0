@section('content')
    @include('html.content-header', ['title' => __('Partner típus')])
    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        @include('partner_types.html.create.card')
    </div>
@endsection
