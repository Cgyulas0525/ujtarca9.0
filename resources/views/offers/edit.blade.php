@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>{{ $offers->offernumber }} {{ date('Y.m.d', strtotime($offers->offerdate)) }}</h1>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">

                <section class="content-header">
                    <h1 class="pull-left">Tételek</h1>
                </section>
                <div class="content">
                    <div class="clearfix"></div>

                    @include('flash::message')

                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered detailstable" style="width: 100%;"></table>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">

                    </div>
                </div>
            </div>

        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($offers, ['route' => ['offers.update', $offers->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('offers.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('offers.index') }}" class="btn btn-default">Kilép</a>
            </div>

           {!! Form::close() !!}

        </div>
    </div>
@endsection
