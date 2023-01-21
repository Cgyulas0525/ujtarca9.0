@section('css')
    @include('layouts.costumcss')
@endsection

@foreach($array as $key => $value)
    <div class="form-group col-sm-{{ $value["width"] }}">
        <div class="form-group col-sm-12">
            <div class="row">
                @if ($value["width"] == 12)
                    <div class="mylabel col-sm-1">
                @else
                    <div class="mylabel col-sm-4">
                @endif
                    {{ $value["label"] }}
                </div>
                @if ($value["width"] == 12)
                    <div class="mylabel col-sm-11">
                @else
                    <div class="mylabel col-sm-8">
                @endif
                    @if ($value["file"])
                        <label class="image__file-upload">Válasszon
                            {{ $value["field"] }}
                        </label>
                    @else
                        {{ $value["field"] }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach

@if (isset($tableFile))
    @include($tableFile)
@endif

@section('scripts')
    @include($scriptFile)
@endsection

