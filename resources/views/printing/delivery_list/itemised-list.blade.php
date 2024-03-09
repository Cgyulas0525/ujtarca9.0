@extends('app-scaffold.html.app')

@section('css')
    @include('app-scaffold.css.costumcss')
@endsection

<body onload="window.print();">
@section('content')
    <section class="content-header">
        {{ $delivery->delivery_number }} {{ date('Y.m.d', strtotime($delivery->date)) }} kiszállítás megrendelései
        <h1>
            <a href="{!! route('deliveries.index') !!}" class="btn btn-default">Kilép</a>
        </h1>
    </section>
    @include('printing.delivery_list.itemised-list-body')
@endsection
</body>

