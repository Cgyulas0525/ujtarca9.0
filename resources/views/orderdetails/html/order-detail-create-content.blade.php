<div class="content px-3">
    @include('adminlte-templates::common.errors')
    <div class="card">
        {!! Form::open(['route' => 'orderdetails.store']) !!}
        <div class="card-body">
            <div class="row">
                @include('orderdetails.fields')
            </div>
        </div>
        @include(('orderdetails.html.order-detail-create-footer'))
        {!! Form::close() !!}
    </div>
</div>
