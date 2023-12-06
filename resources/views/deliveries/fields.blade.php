@section('css')
{{--    @include('layouts.datatables_css')--}}
    @include('layouts.costumcss')
@endsection

@include('layouts.modal', [
        'addModal' => 'addModal',
        'title' => 'Új cím hozzáadása',
        'fields' => 'deliveries.modalFields',
    ])
<!-- Delivery Number Field -->
<div class="form-group col-sm-2">
    {!! Form::label('delivery_number', 'Sorszám:') !!}
    {!! Form::text('delivery_number', isset($delivery) ? $delivery->delivery_number : App\Services\DeliveryService::nextDeliveryNumber(),
        ['class' => 'form-control', 'readonly' => true, 'id' => 'delivery_number']) !!}
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

@include('layouts.modalBtn', [ 'title' => 'Új cím'])

<div class="form-group col-sm-12">
    {!! Form::label('description', 'Megjegyzés:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) !!}
    {!! Form::hidden('id', isset($delivery) ? $delivery->id : null, ['class' => 'form-control', 'id' => 'id']) !!}
</div>

@section('scripts')

    <script src="{{ asset('/js/ajaxsetup.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/js/required.js') }} " type="text/javascript"></script>
    <script src="{{ asset('/js/sweetalert.js') }} " type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {

            ajaxSetup();

            RequiredBackgroundModify('.form-control')

            function isRecord() {
                if ($('#date').val() != 0 && $('#location_id').val() != 0) {
                    $.ajax({
                        type: "POST",
                        url: "{{url('getDeliveryByDateAndLocation')}}",
                        data: {date: $('#date').val(), location: $('#location_id').val(), delivery_number: $('#delivery_number').val()},
                        success: function (res) {
                            if (res > 0) {
                                sw('Van már erre a dátumra és címre kiszállítás!');
                                $("#date").val(null);
                                $("#location_id").val(null);
                            }
                        },
                        error: function(error) {
                            console.error('Hiba történt:', error);
                        }
                    });
                }
            }

            function dateControll() {
                var selectedDate = $("#date").val();
                var currentDate = new Date();
                currentDate = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + (currentDate.getDate() < 10 ? '0' +  currentDate.getDate() : currentDate.getDate());

                if (selectedDate < currentDate) {
                    sw('A kiválasztott dátum nem lehet korábbi, mint a mai dátum.');
                    var formattedDate = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                    $('#date').val(formattedDate);
                    //
                    // $('#date').val(null);
                    return false;
                }

                return true;
            }

            $('#date').change(function () {
                if (dateControll()) {
                    isRecord();
                }
            });

            $('#location_id').change(function () {
                isRecord();
            });
        });
    </script>
@endsection

