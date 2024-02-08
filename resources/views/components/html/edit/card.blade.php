<div class="card">
    {!! Form::model($component, ['route' => ['components.update', $component->id], 'method' => 'patch']) !!}
    @include('components.html.card-body')
    @include('html.card-footer', ['route' => 'components.index'])
    {!! Form::close() !!}
</div>

