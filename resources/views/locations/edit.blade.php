@extends('layouts.app')

@section('content')
    @include('layouts.edit', ['title' => $location->name, 'model' => 'locations', 'record' => $location])

    {{--    <section class="content-header">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="row mb-2">--}}
{{--                <div class="col-sm-12">--}}
{{--                    <h1>--}}
{{--                        {{ $location->name }}--}}
{{--                    </h1>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <div class="content px-3">--}}

{{--        @include('adminlte-templates::common.errors')--}}

{{--        <div class="card">--}}

{{--            {!! Form::model($location, ['route' => ['locations.update', $location->id], 'method' => 'patch']) !!}--}}

{{--            <div class="card-body">--}}
{{--                <div class="row">--}}
{{--                    @include('locations.fields')--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="card-footer">--}}
{{--                {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}--}}
{{--                <a href="{{ route('locations.index') }}" class="btn btn-default"> Kilép </a>--}}
{{--            </div>--}}

{{--            {!! Form::close() !!}--}}

{{--        </div>--}}
{{--    </div>--}}
@endsection
