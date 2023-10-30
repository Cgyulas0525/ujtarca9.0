@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                    Jellemző
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'features.store', 'files'=> true]) !!}

            <div class="card-body">

                <div class="row">
                    @include('features.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('features.index') }}" class="btn btn-default"> Kilép </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
