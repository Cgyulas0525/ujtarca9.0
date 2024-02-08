@include('css.custom-css')
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Név:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Megjegyzés:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) !!}
</div>

<div class="form-group col-sm-6">
    <div class="row">
        <div class="mylabel col-sm-2">
            {!! Form::label('logourl', __('Logó:')) !!}
        </div>
        @if (isset($feature))
            <div class="mylabel col-sm-4">
                <img src = {{ $feature->getFirstMediaUrl($feature->getTable() . $feature->id) }} />
            </div>
        @endif
        <div class="mylabel col-sm-4">
            <label class="image__file-upload">{{ __('Válasszon') }}
                {!! Form::file('file',['class'=>'d-none']) !!}
            </label>
        </div>
    </div>
</div>
