<div class="card-body">
    <div class="row">
        @include('orders.html.fields')
        @if (!isset($detail))
            @include('orders.html.include-modals')
        @endif
    </div>
</div>
