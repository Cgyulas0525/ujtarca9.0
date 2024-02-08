<div class="card">
    {!! Form::model($paymentMethods, ['route' => ['paymentMethods.update', $paymentMethods->id], 'method' => 'patch']) !!}
    @include('payment_methods.html.card-body')
    @include('html.card-footer', ['route' => 'paymentMethods.index'])
    {!! Form::close() !!}
</div>

