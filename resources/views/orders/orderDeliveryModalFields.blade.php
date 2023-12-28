@section('css')
    <link rel="stylesheet" href="pubic/css/app.css">
    @include('layouts.costumcss')

@endsection

<!-- Delivery Number Field -->
<div class="form-group col-sm-12">
    {!! Form::label('delivery_number', 'Sorszám:') !!}
    {!! Form::text('delivery_number', isset($delivery) ? $delivery->delivery_number : App\Services\DeliveryService::nextDeliveryNumber(),
        ['class' => 'form-control', 'readonly' => true]) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-12">
    {!! Form::label('date', 'Dátum:') !!}
    {!! Form::date('date', isset($delivery) ? $delivery->date : \Carbon\Carbon::now()->toDateString(),
        ['class' => 'form-control','id'=>'date', 'required' => true]) !!}
</div>

<!-- Location Id Field -->
<div class="form-group col-sm-12">
    <div class="row">
        <div class="form-group col-sm-9">
            {!! Form::label('location_id', 'Cím:') !!}
            {!! Form::select('location_id', App\Http\Controllers\LocationController::DDDW(), null,
                ['class' => 'select2 form-control', 'id' => 'location_id', 'required' => true]) !!}
        </div>

        <div class="form-group col-sm-3">
            <button type="button" class="btn btn-primary filterBtn" data-toggle="modal" data-target="#addLocationModal">
                Új Cím
            </button>
        </div>
    </div>
</div>

<div class="form-group col-sm-12">
    {!! Form::label('description', 'Megjegyzés:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) !!}
    {!! Form::hidden('id', isset($delivery) ? $delivery->id : null, ['class' => 'form-control', 'id' => 'id']) !!}
</div>

@include('layouts.modal', [
        'addModal' => 'addLocationModal',
        'title' => 'Új cím hozzáadása',
        'fields' => 'deliveries.modalFields',
        'saveBtn' => 'saveLocationBtn',
    ])

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

        $('#addModalBtn').click(function() {
            addModalBtnEvent();
        });
    </script>
@endsection
