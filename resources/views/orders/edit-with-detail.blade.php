@extends('app-scaffold.html.app')
@section('css')
    @include('app-scaffold.css.costumcss')
@endsection
@section('content')
    <div class="content px-3">
        @include('adminlte-templates::common.errors')
        <div class="card">
            {!! Form::model($orders, ['route' => ['orders.update', $orders->id], 'method' => 'patch']) !!}
            @include('orders.html.edit.order-edit-header')
            @include('orders.html.orders-card-body')
            @include('orders.html.edit.order-edit-footer')
            @include('orders.js.order-details-table')
            {!! Form::close() !!}
        </div>
    </div>
@endsection
