@extends('app-scaffold.html.app')

@section('content')
    @include('orderdetails.html.order-detail-content-header')
    @include('orderdetails.html.order-detail-create-content')
    @include('modal.product_modal.product_modal')
@endsection

@section('scripts')
    @include('orderdetails.js.orderdetail-create-script')
@endsection
