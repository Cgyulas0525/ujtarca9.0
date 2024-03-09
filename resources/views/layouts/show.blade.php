@extends('app-scaffold.html.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if ($table->getTable() == 'orders')
                        <h1>{{ $table->ordernumber }}</h1>
                    @else
                        <h1>{{ $table->name }}</h1>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
