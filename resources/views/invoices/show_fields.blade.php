<!-- Partner Id Field -->
<div class="col-sm-12">
    {!! Form::label('partner_id', 'Partner Id:') !!}
    <p>{{ $invoices->partner_id }}</p>
</div>

<!-- Invoicenumber Field -->
<div class="col-sm-12">
    {!! Form::label('invoicenumber', 'Invoicenumber:') !!}
    <p>{{ $invoices->invoicenumber }}</p>
</div>

<!-- Paymentmethod Id Field -->
<div class="col-sm-12">
    {!! Form::label('paymentmethod_id', 'Paymentmethod Id:') !!}
    <p>{{ $invoices->paymentmethod_id }}</p>
</div>

<!-- Amount Field -->
<div class="col-sm-12">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $invoices->amount }}</p>
</div>

<!-- Dated Field -->
<div class="col-sm-12">
    {!! Form::label('dated', 'Dated:') !!}
    <p>{{ $invoices->dated }}</p>
</div>

<!-- Performancedate Field -->
<div class="col-sm-12">
    {!! Form::label('performancedate', 'Performancedate:') !!}
    <p>{{ $invoices->performancedate }}</p>
</div>

<!-- Deadline Field -->
<div class="col-sm-12">
    {!! Form::label('deadline', 'Deadline:') !!}
    <p>{{ $invoices->deadline }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $invoices->description }}</p>
</div>

