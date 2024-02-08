@section('content')
    @include('html.content-header', ['title' => __('Fizetési mód')])
    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        @include('payment_methods.html.create.card')
    </div>
@endsection

