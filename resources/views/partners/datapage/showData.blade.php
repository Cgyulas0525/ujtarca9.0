<div class="mylabel col-sm-1">
    {!! Form::label('name', 'Név:') !!}
</div>
<div class="mylabel col-sm-2">
    <p>{{ $partners->name }}</p>
</div>
<div class="mylabel col-sm-1">
    {!! Form::label('name', 'Cím:') !!}
</div>
<div class="mylabel col-sm-6">
    <p>{{ $partners->fulladdress }}</p>
</div>
<div class="mylabel col-sm-1">
    {!! Form::label('name', 'Státusz:') !!}
</div>
<div class="mylabel col-sm-1">
    <p>{{ ($partners->active == 1) ? 'Aktív' : 'Nem aktív'  }}</p>
</div>
<div class="mylabel col-sm-1">
    {!! Form::label('name', 'Adószám:') !!}
</div>
<div class="mylabel col-sm-2">
    <p>{{ $partners->taxtnumber }}</p>
</div>
<div class="mylabel col-sm-1">
    {!! Form::label('name', 'Bankszámla:') !!}
</div>
<div class="mylabel col-sm-3">
    <p>{{ $partners->bankaccount }}</p>
</div>
<div class="mylabel col-sm-1">
    {!! Form::label('name', 'Telefonszám:') !!}
</div>
<div class="mylabel col-sm-1">
    <p>{{ $partners->phonenumber }}</p>
</div>
<div class="mylabel col-sm-1">
    {!! Form::label('name', 'Email:') !!}
</div>
<div class="mylabel col-sm-2">
    <p>{{ $partners->email }}</p>
</div>
