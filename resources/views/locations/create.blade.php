@extends('layouts.app')

@section('content')
    @include('layouts.create', ['title' => 'Kiszállítási cím', 'model' => 'locations'])
@endsection

