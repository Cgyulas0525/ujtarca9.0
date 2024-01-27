<div class="content px-3">
    @include('adminlte-templates::common.errors')
    <div class="card">
        {!! Form::open(['route' => 'orders.store']) !!}
            @include('orders.html.orders-card-body')
            @include('orders.html.create.order-create-footer')
        {!! Form::close() !!}
    </div>
</div>

