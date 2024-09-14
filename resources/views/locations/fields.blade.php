<div class="form-group col-sm-12">
    @include('flash::message')
</div>

<div class="form-group col-sm-6">
    {!! Form::label('name', 'Név:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Postcode Field -->
<div class="form-group col-sm-2">
    {!! Form::label('postcode', 'Ir.szám:') !!}
    {!! Form::select('postcode', App\Classes\SettlementsClass::settlementsPostcodeDDDW(),
        isset($location->postcode) ? App\Models\Settlements::where('postcode', $location->postcode)->first()->postcode : null,
        ['class' => 'select2 form-control', 'id' => 'postcode']) !!}
</div>

<!-- Settlement Id Field -->
<div class="form-group col-sm-4">
    {!! Form::label('settlement_id', 'Település:') !!}
    {!! Form::select('settlement_id', App\Classes\SettlementsClass::settlementsDDDW(),
        isset($location->settlement_id) ? $location->settlement_id : null,
        ['class' => 'select2 form-control', 'id' => 'settlement_id']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Cím:') !!}
    {!! Form::text('address', isset($location->address) ?? null, ['class' => 'form-control', 'maxlength' => 100]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Megjegyzés:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) !!}
</div>


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
