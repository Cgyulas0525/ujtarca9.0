@extends('layouts.app')

@section('content')
    @include('layouts.edit', ['title' => $delivery->delivery_number, 'model' => 'deliveries', 'record' => $delivery])
{{--    <section class="content-header">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="row mb-2">--}}
{{--                <div class="col-sm-12">--}}
{{--                    <h1>--}}
{{--                        Edit Delivery--}}
{{--                    </h1>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <div class="content px-3">--}}

{{--        @include('adminlte-templates::common.errors')--}}

{{--        <div class="card">--}}

{{--            {!! Form::model($delivery, ['route' => ['deliveries.update', $delivery->id], 'method' => 'patch']) !!}--}}

{{--            <div class="card-body">--}}
{{--                <div class="row">--}}
{{--                    @include('deliveries.fields')--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="card-footer">--}}
{{--                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}--}}
{{--                <a href="{{ route('deliveries.index') }}" class="btn btn-default"> Cancel </a>--}}
{{--            </div>--}}

{{--            {!! Form::close() !!}--}}

{{--        </div>--}}
{{--    </div>--}}
@endsection
