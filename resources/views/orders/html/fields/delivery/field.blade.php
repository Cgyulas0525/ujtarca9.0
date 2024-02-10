<div class="row">
    <div class="form-group col-sm-10">
        @include('orders.html.fields.delivery.field-items')
    </div>
    @if (!isset($detail))
        @include('orders.html.fields.delivery.button')
    @endif
</div>
