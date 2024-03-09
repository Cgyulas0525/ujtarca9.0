@extends('app-scaffold.html.app')

@section('css')
    @include('app-scaffold.css.costumcss')
@endsection

@if (isset($products->first()->delivery_number))
    <body onload="window.print();">
    @section('content')
        <section class="content-header">
            {{ $products->first()->delivery_number }} {{ date('Y.m.d', strtotime($products->first()->date)) }}
            kiszállítás termék összesítő
            <h1>
                <a href="{!! route('deliveries.index') !!}" class="btn btn-default">Kilép</a>
            </h1>

        </section>
        @include('printing.delivery_list.aggregated-list-body')
    @endsection
    @else
        @include('printing.delivery_list.is-not-details')
    @endif
    </body>

