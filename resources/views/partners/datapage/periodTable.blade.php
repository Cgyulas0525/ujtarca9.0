<div class="col-lg-12 col-md-6 col-xs-12">
    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="row">
            <div class="form-group col-sm-6">
                <div class="row">
                    <div class="mylabel col-sm-2">
                        {!! Form::label('year', $title) !!}
                    </div>
                </div>
            </div>

        </div>
        <div class="box-body"  >
            <div class="row">
                <div class="col-lg-4 col-md-6 col-xs-12">
                    <table @class([ $table ])">
                        @include('partners.weekstable')
                    </table>
                </div>
                <div class="col-lg-8 col-md-6 col-xs-12">
                    <figure class="highcharts-figure w-100">
                        <div id="{{ $chartId }}"></div>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</div>

