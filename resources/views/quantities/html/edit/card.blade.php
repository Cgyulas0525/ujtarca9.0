<div class="card">
    {!! Form::model($quantities, ['route' => ['quantities.update', $quantities->id], 'method' => 'patch']) !!}
    @include('quantities.html.card-body')
    @include('html.card-footer', ['route' => 'quantities.index'])
    {!! Form::close() !!}
</div>

