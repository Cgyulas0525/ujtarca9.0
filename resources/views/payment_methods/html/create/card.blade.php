<div class="card">
    {!! Form::open(['route' => 'paymentMethods.store']) !!}
    @include('payment_methods.html.card-body')
    @include('payment_methods.html.card-footer')
    {!! Form::close() !!}
</div>

