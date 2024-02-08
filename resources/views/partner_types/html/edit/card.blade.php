<div class="card">
    {!! Form::model($partnerTypes, ['route' => ['partnerTypes.update', $partnerTypes->id], 'method' => 'patch']) !!}
    @include('payment_methods.html.card-body')
    @include('html.card-footer', ['route' => 'partnerTypes.index'])
    {!! Form::close() !!}
</div>


