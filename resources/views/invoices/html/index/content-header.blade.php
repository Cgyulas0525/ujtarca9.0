<section class="content-header">
    <div class="form-group col-sm-12">
        <h4>Számla</h4>
        <div class="form-group col-sm-6">
            <div class="row">
                @if (Auth::user() !== null)
                    <div class="mylabel col-sm-1">
                        {!! Form::label('year', 'Év:') !!}
                    </div>
                    <div class="col-sm-2">
                        {!! Form::select('year', SelectService::invoicesYearsSelect(), date('Y'),
                                ['class'=>'select2 form-control', 'id' => 'year']) !!}
                    </div>
                    <div class="mylabel col-sm-2">
                        {!! Form::label('partner', 'Partner:') !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::select('partner', SelectService::selectSupplier(), null,
                                ['class'=>'select2 form-control', 'id' => 'partner']) !!}
                    </div>
                    <div class="col-sm-1">
                        <a href="#" class="btn btn-success filterBtnTop">Szűrés</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
