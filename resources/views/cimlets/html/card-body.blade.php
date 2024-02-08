<div class="card-body">
    <div class="row">
        @include('formGroup.formGroupFromController', ['array' => App\Http\Controllers\CimletsController::fields(isset($cimlets) ? $cimlets : null),
                                   'scriptFile' => 'formGroup.emptyScript'])
    </div>
</div>

