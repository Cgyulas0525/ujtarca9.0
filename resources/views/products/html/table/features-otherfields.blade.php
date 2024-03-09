<div class="form-group col-sm-6">
    <div class="row">
        <div class="form-group col-sm-10">
            {!! Form::select('features', \App\Http\Controllers\FeatureProductController::notInFeatureProductPivot($products->id), null,
                        ['class'=>'select2 form-control', 'id' => 'features', 'multiple' => 'multiple']) !!}
        </div>
        <div class="form-group col-sm-2">
            <a href="#" class="btn btn-success alapgomb printBtn" title="Mentés" id="featuresSaving">Mentés</a>
        </div>
    </div>
</div>
