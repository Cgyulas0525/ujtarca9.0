<div class="card">
    {!! Form::model($paymentMethods, ['route' => ['paymentMethods.update', $paymentMethods->id], 'method' => 'patch']) !!}
    @include('payment_methods.html.card-body')
    @include('payment_methods.html.edit.card-footer')
    {!! Form::close() !!}
</div>

