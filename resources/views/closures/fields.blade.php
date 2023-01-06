<!-- Closuredate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('closuredate', 'Closuredate:') !!}
    {!! Form::text('closuredate', null, ['class' => 'form-control','id'=>'closuredate']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#closuredate').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Card Field -->
<div class="form-group col-sm-6">
    {!! Form::label('card', 'Card:') !!}
    {!! Form::number('card', null, ['class' => 'form-control']) !!}
</div>

<!-- Szcard Field -->
<div class="form-group col-sm-6">
    {!! Form::label('szcard', 'Szcard:') !!}
    {!! Form::number('szcard', null, ['class' => 'form-control']) !!}
</div>

<!-- Dayduring Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dayduring', 'Dayduring:') !!}
    {!! Form::number('dayduring', null, ['class' => 'form-control']) !!}
</div>