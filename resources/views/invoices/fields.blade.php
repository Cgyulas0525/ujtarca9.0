<!-- Partner Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('partner_id', 'Partner Id:') !!}
    {!! Form::number('partner_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Invoicenumber Field -->
<div class="form-group col-sm-6">
    {!! Form::label('invoicenumber', 'Invoicenumber:') !!}
    {!! Form::text('invoicenumber', null, ['class' => 'form-control','maxlength' => 25,'maxlength' => 25]) !!}
</div>

<!-- Paymentmethod Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('paymentmethod_id', 'Paymentmethod Id:') !!}
    {!! Form::number('paymentmethod_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Dated Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dated', 'Dated:') !!}
    {!! Form::text('dated', null, ['class' => 'form-control','id'=>'dated']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#dated').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Performancedate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('performancedate', 'Performancedate:') !!}
    {!! Form::text('performancedate', null, ['class' => 'form-control','id'=>'performancedate']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#performancedate').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Deadline Field -->
<div class="form-group col-sm-6">
    {!! Form::label('deadline', 'Deadline:') !!}
    {!! Form::text('deadline', null, ['class' => 'form-control','id'=>'deadline']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#deadline').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control','maxlength' => 500,'maxlength' => 500]) !!}
</div>