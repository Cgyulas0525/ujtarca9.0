<div class="card">
    {!! Form::model($feature, ['route' => ['features.update', $feature->id], 'method' => 'patch', 'enctype' => 'multipart/form-data']) !!}
    @include('features.html.card-body')
    @include('html.card-footer', ['route' => 'features.index'])
    {!! Form::close() !!}
</div>

