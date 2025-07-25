<section class="content-header">
    <div class="form-group col-sm-12">
        <div class="form-group col-sm-6">
            <div class="row">
                <div class="col-sm-2">
                    <h4>Számla</h4>
                </div>
                <div class="col-sm-2">
                    @if (Route::currentRouteName() == 'invoicesIndex')
                        <a href="#" class="btn btn-info filterBtnTop" id="referredBtn">Utalatlan</a>
                    @endif
                    @if (Route::currentRouteName() == 'notReferredInvoicesIndex')
                        <a href="#" class="btn btn-info filterBtnTop" id="referredBtn">Vissza</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group col-sm-6">
            <div class="row">
                @if (Auth::user() !== null)
                    <div class="mylabel col-sm-1">
                        {!! Form::label('year', 'Év:') !!}
                    </div>
                    <div class="col-sm-2">
                        {!! Form::select('year', SelectService::invoicesYearsSelect(), Illuminate\Support\Facades\Session::get('invoiceYear'),
                                ['class'=>'select2 form-control', 'id' => 'year']) !!}
                    </div>
                    <div class="mylabel col-sm-2">
                        {!! Form::label('partner', 'Partner:') !!}
                    </div>
                    <div class="col-sm-5">
                        {!! Form::select('partner', SelectService::selectSupplier(), Illuminate\Support\Facades\Session::get('invoicePartner'),
                                ['class'=>'select2 form-control', 'id' => 'partner']) !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
