@section('content')
    @include('html.content-header', ['title' => $partnerTypes->name])
    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        @include('partner_types.html.edit.card')
    </div>
@endsection
