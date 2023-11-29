@section('css')
    @include('layouts.datatables_css')
    @include('layouts.costumcss')
@endsection
<!-- Delivery Number Field -->
<div class="form-group col-sm-2">
    {!! Form::label('delivery_number', 'Sorszám:') !!}
    {!! Form::text('delivery_number', isset($delivery) ? $delivery->delivery_number : App\Services\DeliveryService::nextDeliveryNumber(),
        ['class' => 'form-control', 'readonly' => true]) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-2">
    {!! Form::label('date', 'Dátum:') !!}
    {!! Form::date('date', isset($delivery) ? $delivery->date : \Carbon\Carbon::now()->toDateString(),
        ['class' => 'form-control','id'=>'date', 'required' => true]) !!}
</div>

<!-- Location Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location_id', 'Cím:') !!}
    {!! Form::select('location_id', App\Http\Controllers\LocationController::DDDW(), null,
        ['class' => 'select2 form-control', 'id' => 'location_id', 'required' => true]) !!}
</div>
<div class="form-group col-sm-2">
    <button type="button" class="btn btn-primary filterBtn" data-toggle="modal" data-target="#addPartnerModal">
        Új Cím
    </button>
</div>

<div class="form-group col-sm-12">
    {!! Form::label('description', 'Megjegyzés:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) !!}
</div>

@include('deliveries.modal')

@section('scripts')
    <script src="{{ asset('/js/ajaxsetup.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/js/required.js') }} " type="text/javascript"></script>
    @include('functions.settlement.settlementPostcode_js')

    <script type="text/javascript">
        $(function () {
            ajaxSetup();
            RequiredBackgroundModify('.form-control')
        });

        $('#addPartnerBtn').click(function() {
            $.ajax({
                method: 'POST',
                url: "{{url('addLocation')}}",
                data: {
                    name: $('#name').val(),
                    postcode: $('#postcode').val(),
                    settlement_id: $('#settlement_id').val(),
                    address: $('#address').val(),
                },
                // data: $('#addPartnerForm').serialize(), // Az űrlap adatainak elküldése


                success: function(response) {
                    console.log(response.message);
                    // Frissítsd a select opcióit a frissített partnerlistával
                    var locationSelect = $('#location_id');
                    locationSelect.empty(); // Törölje az összes előző opciót

                    $.each(response.locations, function(index, location) {
                        // Hozzáfűz minden új partnert a select-hez
                        locationSelect.append('<option value="' + location.id + '">' + location.name + '</option>');
                    });

                    $('#addPartnerModal').modal('hide');

                    $.ajax({
                        method: 'GET',
                        url: "{{url('getLocationByName')}}",
                        data: {
                            name: $('#name').val(),
                        },
                        success: function(response) {
                            console.log(response);
                            $('#location_id').val(response)
                        },
                        error: function(error) {
                            console.error('Hiba történt:', error);
                        }
                    });
                },
                error: function(error) {
                    console.error('Hiba történt:', error);
                }
            });
        });

    </script>
@endsection
