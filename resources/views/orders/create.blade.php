@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        {{ App\Services\OrderService::orderTypeByCookie() }}
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'orders.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('orders.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('orders.index') }}" class="btn btn-default"> Kilép </a>
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
    @include('functions.requiredField')

    @include('orders.partner_modal.modalScript')
    @include('functions.partnerScripts.emailChange')
    @include('functions.partnerScripts.nameChange')
    @include('functions.partnerScripts.newPartnerByModal')

    <script type="text/javascript">

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        RequiredBackgroundModify('.form-control')

        // $('#addModalBtn').click(function() {
        //     addModalBtnEvent();
        // });
    </script>
@endsection
