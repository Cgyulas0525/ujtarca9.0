<div class="row">
    <div class="form-group col-sm-10">
        @include('orders.html.fields.partner.field-items')
    </div>
    @if (!isset($detail))
        @include('orders.html.fields.partner.button')
    @endif
</div>
