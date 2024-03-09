@extends('app-scaffold.html.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Kiszállítás
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'deliveries.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('deliveries.fields')
                </div>

            </div>

            <div class="card-footer">
                <a href="#" class="btn btn-primary" id="otherBtn">Ment</a>
                <a href="{{ route('deliveries.index') }}" class="btn btn-default"> Kilép </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('/js/required.js') }} " type="text/javascript"></script>
    @include('functions.settlement.settlementPostcode_js')
    @include('deliveries.addModalBtn_js')
    @include('functions.sweetalert_js')

    <script type="text/javascript">

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        RequiredBackgroundModify('.form-control')

        $('#addModalBtn').click(function () {
            addModalBtnEvent();
        });
    </script>
@endsection
