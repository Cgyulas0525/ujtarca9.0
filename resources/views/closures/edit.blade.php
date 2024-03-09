@extends('app-scaffold.html.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Zárás: {{ date('Y.m.d', strtotime($closures->closuredate)) }}</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($closures, ['route' => ['closures.update', $closures->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('formGroup.formGroupFromController', ['array' => App\Http\Controllers\ClosuresController::fields(isset($closures) ? $closures : null),
                                               'scriptFile' => 'closures.fieldScript',
                                               'tableFile' => 'closures.tableFile'])
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
                {{--                <a href="{{ route('closures.index') }}" class="btn btn-default">Kilép</a>--}}
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection

