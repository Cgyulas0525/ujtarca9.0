<div class="card-footer">
    {!! Form::submit(__('Ment'), ['class' => 'btn btn-primary', 'id' => 'saveBtn']) !!}
{{--    {!! Form::submit('Ment', ['class' => 'btn btn-primary']) !!}--}}
    <a href="{{ route('editDetails', ['id' => $orders->id]) }}" class="btn btn-default"> Kilép </a>
</div>
