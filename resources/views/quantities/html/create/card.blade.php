<div class="card">
    {!! Form::open(['route' => 'quantities.store']) !!}
    @include('quantities.html.card-body')
    @include('html.card-footer', ['route' => 'quantities.index'])
    {!! Form::close() !!}
</div>

