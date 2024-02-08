<div class="card-body">
    <div class="row">
        @include('formGroup.formGroupFromController', ['array' => App\Http\Controllers\PaymentMethodsController::fields(isset($paymentMethods) ? $paymentMethods : null),
                                   'scriptFile' => 'formGroup.emptyScript'])
    </div>
</div>
