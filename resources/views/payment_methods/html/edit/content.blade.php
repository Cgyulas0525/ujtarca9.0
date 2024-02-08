@section('content')
    @include('html.content-header', ['title' => $paymentMethods->name])
    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        @include('payment_methods.html.edit.card')
    </div>
@endsection
