@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        {{ $delivery->delivery_number }}
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($delivery, ['route' => ['deliveries.update', $delivery->id], 'method' => 'patch']) !!}

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
    @include('functions.sweetalert_js')
    <script src="{{ asset('/js/required.js') }} " type="text/javascript"></script>
    @include('functions.settlement.settlementPostcode_js')

    <script type="text/javascript">

        $(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });

        $('#otherBtn').click(function (e) {
            $.ajax({
                type:"POST",
                url:"{{url('updateModal')}}",
                data: {
                    id: $('#id').val(),
                    delivery_number: $('#delivery_number').val(),
                    date: $('#date').val(),
                    location_id: $('#location_id').val(),
                    description: $('#description').val(),
                },
                success: function (response) {
                    console.log('Ok:', response);
                    window.location.href = '/deliveries'
                },
                error: function (response) {
                    console.log('Error:', response);
                    alert('nem ok');
                }
            });
        });

        RequiredBackgroundModify('.form-control')

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
