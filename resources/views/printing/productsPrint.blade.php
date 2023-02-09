@extends('layouts.app')

<body onload="window.print();">
    @section('content')

        <section class="content-header">
            Termékek
            <h1>
                <a href="{!! route('products.index') !!}" class="btn btn-default">Kilép</a>
            </h1>
        </section>
        @include('printing.productsPrintingBody')
    @endsection
</body>
