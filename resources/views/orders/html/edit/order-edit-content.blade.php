<div class="content px-3">
    @include('adminlte-templates::common.errors')
    <div class="card">
        {!! Form::model($orders, ['route' => ['orders.update', $orders->id], 'method' => 'patch']) !!}
            @include('orders.html.edit.order-edit-header')
            @include('orders.html.orders-card-body')
            @include('orders.html.edit.order-edit-footer')
        {!! Form::close() !!}
    </div>
</div>

