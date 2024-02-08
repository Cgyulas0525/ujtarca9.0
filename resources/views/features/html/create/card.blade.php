<div class="card">
    {!! Form::open(['route' => 'features.store']) !!}
    @include('features.html.card-body')
    @include('html.card-footer', ['route' => 'features.index'])
    {!! Form::close() !!}
</div>


