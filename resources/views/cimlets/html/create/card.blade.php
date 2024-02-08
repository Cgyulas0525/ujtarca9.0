<div class="card">
    {!! Form::open(['route' => 'paymentMethods.store']) !!}
    @include('cimlets.html.card-body')
    @include('html.card-footer', ['route' => 'cimlets.index'])
    {!! Form::close() !!}
</div>


