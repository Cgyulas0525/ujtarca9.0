@extends('app-scaffold.html.app')

@section('css')
    @include('app-scaffold.css.costumcss')
@endsection

@section('content')
    <section class="content-header text-center w-100">
        <h1>Nincs listázandó tétel</h1>
        <h1>
            <a href="{!! route('deliveries.index') !!}" class="btn btn-default">Kilép</a>
        </h1>
    </section>

@endsection
