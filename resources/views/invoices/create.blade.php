@extends('app-scaffold.html.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Számla</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'invoices.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('formGroup.formGroupFromController', ['array' => App\Http\Controllers\InvoicesController::fields(isset($invoices) ? $invoices : null),
                                                                   'scriptFile' => 'invoices.fieldScript'])

                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('invoices.index') }}" class="btn btn-default">Kilép</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
