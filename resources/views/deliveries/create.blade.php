@extends('layouts.app')

@section('content')
    @include('layouts.create', ['title' => 'Kiszállítás', 'model' => 'deliveries'])
@endsection
