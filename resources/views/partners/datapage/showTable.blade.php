<div class="col-lg-12 col-md-6 col-xs-12">
    <div class="clearfix"></div>
    <div class="box box-primary">
        <div class="row">
            <div class="form-group col-sm-6">
                <div class="row">
                    <div class="mylabel col-sm-3">
                        {!! Form::label('year', 'Számlák:') !!}
                    </div>
                    <div class="mylabel col-sm-2">
                        {!! Form::label('year', 'Év:') !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::select('year', SelectService::invoicesYearsSelect(),date('Y'),
                                ['class'=>'select2 form-control', 'id' => 'year']) !!}
                    </div>
                    <div class="col-sm-3" id="gifDiv">
                        <img src={{ URL::asset('/public/img/loading.gif') }}
                            class="gifcenter" >
                    </div>
                </div>
            </div>

        </div>
        <div class="box-body"  >
            <table class="table table-hover table-bordered invoicetable w-100">
                @include('partners.table')
            </table>
        </div>
    </div>
</div>
