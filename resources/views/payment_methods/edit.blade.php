@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>{{ $paymentMethods->name }}</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($paymentMethods, ['route' => ['paymentMethods.update', $paymentMethods->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('formGroup.formGroupFromController', ['array' => App\Http\Controllers\PaymentMethodsController::fields(isset($paymentMethods) ? $paymentMethods : null),
                                               'scriptFile' => 'formGroup.emptyScript'])
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('paymentMethods.index') }}" class="btn btn-default">Kilép</a>
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection
