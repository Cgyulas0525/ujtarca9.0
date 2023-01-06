@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>{{ $invoices->partner->name }} {{ $invoices->dated }} {{ $invoices->invoicenumber }}</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($invoices, ['route' => ['invoices.update', $invoices->id], 'method' => 'patch']) !!}

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
