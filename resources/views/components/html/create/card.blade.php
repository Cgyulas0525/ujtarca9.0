<div class="card">
    {!! Form::open(['route' => 'components.store']) !!}
    @include('components.html.card-body')
    @include('html.card-footer', ['route' => 'components.index'])
    {!! Form::close() !!}
</div>


