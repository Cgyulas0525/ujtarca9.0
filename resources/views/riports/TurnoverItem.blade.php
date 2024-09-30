<div class="{{ $tabPane }}" id="{{ $id }}">
    <section class="content-header">
        @if ($id == 'bevkiheti')
            <div class="row">
                <div class="mylabel col-sm-6">
                    <h1> {{ $title }} </h1>
                </div>
                <div class="mylabel col-sm-2">
                    {!! Form::label('year', 'Időszak (hónap):') !!}
                </div>
                <div class="col-sm-2">
                    {!! Form::select('year', $parameters['monthPeriods'], 'SIX',
                            ['class'=>'select2 form-control', 'id' => 'period']) !!}
                </div>
            </div>
        @else
            <h1> {{ $title }}</h1>
        @endif
    </section>
    <figure class="highcharts-figure w-100">
        <div id="{{ $chartId }}"></div>
    </figure>
</div>
