<div class="card">
    {!! Form::open(['route' => 'partnerTypes.store']) !!}
    @include('payment_methods.html.card-body')
    @include('html.card-footer', ['route' => 'partnerTypes.index'])
    {!! Form::close() !!}
</div>

