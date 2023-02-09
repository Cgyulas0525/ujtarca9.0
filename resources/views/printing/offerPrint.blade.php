@extends('layouts.app')

@section('css')
    @include('layouts.costumcss')
@endsection

<body onload="window.print();">
    @section('content')
        <section class="content-header">
            {{ $offer->offernumber }} {{ date('Y.m.d', strtotime($offer->offerdate)) }} megrendelés
            <h1>
                <a href="{!! route('offersEdit', ['id' => $offer->id]) !!}" class="btn btn-default">Kilép</a>
            </h1>
        </section>
        @include('printing.offerPrintingBody')

    @endsection
</body>
