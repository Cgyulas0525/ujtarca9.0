@extends('layouts.app')

@section('css')
    @include('layouts.costumcss')
@endsection

<body onload="window.print();">
    @section('content')
        <section class="content-header">
            {{ $order->ordernumber }} {{ date('Y.m.d', strtotime($order->orderdate)) }} megrendelés
            <h1>
                <a href="{!! route('ordersEdit', ['id' => $order->id]) !!}" class="btn btn-default">Kilép</a>
            </h1>
        </section>
        @include('printing.orderPrintingBody')

    @endsection
</body>
