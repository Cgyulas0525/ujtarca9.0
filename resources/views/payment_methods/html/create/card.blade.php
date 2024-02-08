<div class="card">
    {!! Form::open(['route' => 'paymentMethods.store']) !!}
    @include('payment_methods.html.card-body')
    @include('html.card-footer', ['route' => 'paymentMethods.index'])
    {!! Form::close() !!}
</div>

