@extends('app-scaffold.html.app')

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
                <a href="{{ route('locations.edit', ['location' => $location->id]) }}" class="btn btn-default">
                    Kilép </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection


@section('scripts')

    @include('functions.ajax_js')
    @include('functions.required_js')
    @include('functions.sweetalert_js')

    @include('functions.settlement.settlementPostcode_js')

    <script type="text/javascript">
        $(function () {
            ajaxSetup();
            RequiredBackgroundModify('.form-control')
        });
    </script>
@endsection
