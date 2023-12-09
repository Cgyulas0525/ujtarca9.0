@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        {{ $location->name }}
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'locationPartnersStore', 'method' => 'POST']) !!}

            <div class="card-body">
                <div class="row">
                    @include('locations.partners.field', [
                                    'locations' => $location,
                                    'partnertype' => App\Services\PartnerTypeService::getByName(App\Enums\PartnerTypeEnum::DELIVERY_CUSTOMER->value)])
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('locations.edit', ['location' => $location->id]) }}" class="btn btn-default"> Kilép </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection


@section('scripts')

    <script src="{{ asset('/js/ajaxsetup.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/js/required.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/js/sweetalert.js') }} " type="text/javascript"></script>

    @include('functions.settlement.settlementPostcode_js')

    <script type="text/javascript">
        $(function () {
            ajaxSetup();
            RequiredBackgroundModify('.form-control')
        });
    </script>
@endsection
