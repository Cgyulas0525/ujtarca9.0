<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>
                    {{ $title }}
                </h1>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">

    @include('adminlte-templates::common.errors')

    <div class="card">

        {!! Form::model($record, ['route' => [$model . '.update', $record->id], 'method' => 'patch']) !!}

        <div class="card-body">
            <div class="row">
                @include($model . '.fields')
            </div>
        </div>

        <div class="card-footer">
            {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route($model . '.index') }}" class="btn btn-default"> Kilép </a>
        </div>

        {!! Form::close() !!}

    </div>
</div>
