<div class="card-body">
    <div class="row">
        @include('formGroup.formGroupFromController', ['array' => App\Http\Controllers\PartnerTypesController::fields(isset($partnerTypes) ? $partnerTypes : null),
                                   'scriptFile' => 'formGroup.emptyScript'])
    </div>
</div>
